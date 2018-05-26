<?php

	/**
		Aplikasi sebagai kelas utama
		Untuk menyajikan halaman utama / list barang
		
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
		
		/**
			Mengambil Data Barang
		**/
		public function getListBarang($iterateFunc)
		{
			return $this->db->execRawQ('SELECT `kodebrg`, `nama`, `harga`, `stok`, `gambar` FROM `barang`', $iterateFunc);
		}
		
		/**
			Method Utama
		**/
		public static function mainApp()
		{
			$app = new App();
			
			include 'application/templates/header.php';
			include 'application/views/index.php';
			include 'application/templates/footer.php';
		}
		
	}

?>