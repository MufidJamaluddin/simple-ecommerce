<?php

	/**
		Aplikasi sebagai kelas utama
		Untuk menambah, mengurangi, dan menghapus barang
		
		@author : Mufid Jamaluddin	
	**/
	class App
	{
		/**
			Method untuk Tambah Barang
		**/
		public function tambahBarang($kode)
		{
			// Tambah Jml Barang
			if(isset($_SESSION['shp_cart'][$kode]['jml']))
				$_SESSION['shp_cart'][$kode]['jml']++;
			else
			{
				// Sanitasi
				$kode = htmlentities($kode);
				$kode = str_replace(' ','', $kode);
				$kode = str_replace('"','', $kode);
				// Inisiasi jumlah
				$_SESSION['shp_cart'][$kode]['jml'] = 1;
			}		
		
		}
		
		/**
			Method untuk Kurangi Barang
		**/
		public function kurangiBarang($kode)
		{
			// Kurangi Barang
			if(isset($_SESSION['shp_cart'][$kode]['jml']))
			{
				$_SESSION['shp_cart'][$kode]['jml']--;
				
				// Jika Barang yang dikurang hasilnya kurang dari 1
				// Maka unset barang
				if($_SESSION['shp_cart'][$kode]['jml'] < 1)
				{
					unset($_SESSION['shp_cart'][$kode]);
				}
			}
			if(isset($_SESSION['shp_cart']) and sizeof($_SESSION['shp_cart']) < 1)
				unset($_SESSION['shp_cart']);
			
		}
		
		/**
			Method untuk menghapus semua barang di cart
		**/
		public function hapusSemuaBarang()
		{
			if(isset($_SESSION['shp_cart']))
				unset($_SESSION['shp_cart']);
		}
		
		/**
			Method untuk Menghapus Barang
		**/
		public function hapusBarang($kode)
		{
			// Mendapatkan Jumlah Barang
			if(isset($_SESSION['shp_cart'][$kode]['jml']))
			{
				$jml_brg = $_SESSION['shp_cart'][$kode]['jml'];
				
				// Hapus Barang
				unset($_SESSION['shp_cart'][$kode]);
								
				// Jika Jumlah Total < 1, Maka Keranjang Kosong
				if(sizeof($_SESSION['shp_cart']) < 1)
					unset($_SESSION['shp_cart']);
			}
			
		}
		
		/**
			Method Utama
		**/
		public static function mainApp()
		{
			if(isset($_GET['action']) and isset($_GET['kode']))
			{
				$action = $_GET['action'];
				$kode = $_GET['kode'];
				
				MufidJ\Lib\SessionAdapter::start();
				
				$obj = new App();
				
				switch($action)
				{
					
					case 'add':
						$obj->tambahBarang($kode);	
						break;
						
					case 'b_add':
						$obj->tambahBarang($kode);	
						break;
					
					case 'min':
						$obj->kurangiBarang($kode);
						break;
						
					case 'delete':
						$obj->hapusBarang($kode);
						break;
					
				}
				
				if($action === 'add')
					echo sizeof($_SESSION['shp_cart']);
				else
					echo '<meta http-equiv="refresh" content="0;url=../index.php/cart"/>';
			}
			else if(isset($_GET['action']))
			{
				$obj = new App();
				
				MufidJ\Lib\SessionAdapter::start();
				
				if($_GET['action'] === 'delete_all')
					$obj->hapusSemuaBarang();
				
				if(isset($_SESSION['grand_total']))
					unset($_SESSION['grand_total']);
				
				echo '<meta http-equiv="refresh" content="0;url=../index.php/cart"/>';
			}
			else
				echo '<meta http-equiv="refresh" content="0;url=../index.php/cart"/>';
		}
	}

?>