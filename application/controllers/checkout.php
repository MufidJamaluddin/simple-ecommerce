<?php

	/**
		Aplikasi sebagai kelas utama
		
		@author : Mufid Jamaluddin	
	**/
	require_once 'library/dbadapter.php';
	require_once 'library/nomortrx.php';
	
	class App
	{
		// Db MySQLi Adapter
		private $db;
		
		// Untuk Generate Nomor Penjualan
		private $nopjl_adapter;
		
		/**
			Konstruktor, Inisiasi Db MySQLi
		**/
		public function __construct()
		{
			$this->db = new MufidJ\Lib\DbAdapter();
			$this->nopjl_adapter = new MufidJ\Lib\NomorTrx('PJL',5);
		}
		
		/**
			Method Mendapatkan WHERE Query
		**/
		public function getListFromSession()
		{
			$m_session = MufidJ\Lib\SessionAdapter::getSession();
			
			foreach( $m_session['shp_cart'] as $key => $val )
			{
				$temp[] = ' `kodebrg` = "'.$key.'"';
			}
			
			if(isset($temp))
				return implode(' or ', $temp);
			else
				return '1';
		}
		
		/**
			Mengambil Data Barang
		**/
		public function checkStokDb($iterateFunc)
		{
			$where = $this->getListFromSession();
			return $this->db->execRawQ('SELECT `kodebrg`, `stok`  FROM `barang` WHERE '.$where, $iterateFunc);
		}
		
		/**
			Menyimpan Data Penjualan ke Database
		**/
		public function simpanPenjualan($values)
		{
			$conn = $this->db->getConnection();
			
			$stmt = $conn->prepare('INSERT INTO `penjualan`(`nopjl`, `tgl`, `nama`, `hp`, `alamat`) VALUES (?, ?, ?, ?, ?)');
			
			$stmt->bind_param("sssss", $values['nopjl'], $values['tgl'], $values['nama'], $values['hp'], $values['alamat']);
			
			$stmt->execute();
			
			return $stmt->affected_rows > 0;
		}
		
		/**
			Mengambil dan Increment dari Nomor Penjualan Sebelumnya
			Jika belum, Maka Return PJL00001
		**/
		public function getNoPjl()
		{
			$result = $this->db->getArrRawQ('SELECT `nopjl` FROM `penjualan` ORDER BY `nopjl` DESC LIMIT 1');
			
			if(isset($result[0]->nopjl))
			{
				// Tambah 1 dari No Pjl Terakhir
				return $this->nopjl_adapter->increment($result[0]->nopjl);
			}
			else
			{
				// Membuat NoPjl PJL00001
				return $this->nopjl_adapter->generate(1);
			}
		}
		
		/**
			Menyimpan List Barang ke Tabel Jual
		**/
		public function simpanJual($nopjl)
		{
			$conn = $this->db->getConnection();
			$m_session = MufidJ\Lib\SessionAdapter::getSession();
			
			// Memulai Transaksi, matikan autocommit
			$conn->autocommit(FALSE);
			
			foreach( $m_session['shp_cart'] as $kodebrg => $val )
			{
				// Kurangi Stok
				$conn->query('UPDATE `barang` SET stok = stok - '.$val['jml'].' WHERE `kodebrg` = "'.$kodebrg.'";');
				// Insert ke table Jual
				$conn->query('INSERT INTO `jual`(`nopjl`, `kodebrg`, `harga`, `jumlah`) VALUES ("'.$nopjl.'","'.$kodebrg.'","'.$val['harga'].'","'.$val['jml'].'");');
			}
						
			// Kommit Transaksi
			$conn->commit();
			
			return true;
		}
		
		/**
			Mengecek Ketersediaan Stok
		**/
		public function checkStok()
		{
			MufidJ\Lib\SessionAdapter::start();
			
			$this->checkStokDb(function($count, $barang){
				
				if($barang->stok < $_SESSION['shp_cart'][$barang->kodebrg]['jml'])
				{
					$_SESSION['shp_cart'][$barang->kodebrg]['instock'] = false;
					$_SESSION['instock'] = false;
				}
				
			});
			
			if(isset($_SESSION['instock']))
			{
				return $_SESSION['instock'] === false;
			}
			else
			{
				return true;
			}
		}
		
		/**
			Menyimpan Transaksi
		**/
		public function simpanTransaksi()
		{
			// Mendapatkan NoPjl
			$data['nopjl'] = $this->getNoPjl();
			
			// Tanggal dari Hari Ini
			$data['tgl'] = date('Y-m-d');
			
			// Nama
			// Hanya Html Entities, karena query string otomatis diescape oleh query Binding
			$data['nama'] = htmlentities($_POST['nama']);
			
			// Alamat
			// Hanya Html Entities, karena query string otomatis diescape oleh query Binding
			$data['alamat'] = htmlentities($_POST['alamat']);
			
			// No HP
			// Hanya Html Entities, karena query string otomatis diescape oleh query Binding
			$data['hp'] = htmlentities($_POST['hp']);
			
			// Jika Insert NoPjl baru ke Tabel Sukses (int > 0)
			if($this->simpanPenjualan($data) > 0)
			{
				// Boolean : Simpan Semua Barang dalam Session ke Db Sukses atau Gagal
				return $this->simpanJual($data['nopjl']);
			}
			else
			{
				return false;
			}
		}

		/**
			Method Utama
		**/
		public static function mainApp()
		{
			$app = new App();
			
			include 'application/templates/header1.php';
			
			if(isset($_POST['nama']) and isset($_POST['hp']) and isset($_POST['alamat']))
			{	
				if($app->checkStok())
				{
					// Menyimpan Transaksi
					if($app->simpanTransaksi())
					{
						include 'application/views/checkout_sukses.php';
					}
					else
					{
						include 'application/views/checkout_gagal.php';
					}	
				}
				else
				{
					include 'application/views/checkout_gagal.php';
					echo "<h1>Stok Tidak Mencukupi!<h1>";
				}
			}
			
			include 'application/templates/footer1.php';
		}
		
	}

?>