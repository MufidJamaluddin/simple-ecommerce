<?php

	/**
		
		@author : Mufid Jamaluddin	
	**/
	require_once 'library/dbadapter.php';
	
	class App
	{
		// Db MySQLi Adapter
		private $db;
		
		/**
			Konstruktor, Inisiasi Db MySQLi
		**/
		public function __construct()
		{
			$this->db = new MufidJ\Lib\DbAdapter();
		}
		
		public function insertPembayaran($nopjl, $jml_bayar)
		{
			return $this->db->getRawAffRows('INSERT INTO `pembayaran`(`nopjl`, `tgl_bayar`, `jml_bayar`) VALUES ("'.$nopjl.'","'.date('Y-m-d').'","'.$jml_bayar.'")') > 0;
		}
		
		public function getListKonfirmasi($iterateFunc)
		{
			$query = 'SELECT jual.nopjl as nopjl, kodebrg, harga, jumlah, tgl, nama, hp, alamat, tgl_bayar, jml_bayar FROM jual NATURAL JOIN penjualan LEFT JOIN pembayaran ON jual.nopjl = pembayaran.nopjl';
			$this->db->execRawQ($query, $iterateFunc);
		}
		
		/**
			Method Utama
		**/
		public static function mainApp()
		{
			
			if(isset($_POST['nopjl']) and isset($_POST['jml_bayar']))
			{
				$app = new App();
				
				$nopjl = $_POST['nopjl'];
				$jml_bayar = $_POST['jml_bayar'];
				$date = date('Y-m-d');
				
				if($app->insertPembayaran($nopjl, $jml_bayar))
				{
					include 'application/templates/header1.php';
					include 'application/views/konfirmasi_sukses.php';
					include 'application/templates/footer1.php';
				}
			}
			else
			{
				$app = new App();
				
				include 'application/templates/header1.php';
				include 'application/views/list_konfirmasi.php';
				include 'application/templates/footer1.php';
			}
			
		}
		
	}

?>