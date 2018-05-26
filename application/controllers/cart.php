<?php

	/**
		Aplikasi sebagai kelas utama
		Untuk menampilkan keranjang Belanja
		
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
		public function getListBarang($iterateFunc)
		{
			$where = $this->getListFromSession();
			//echo '<br/>SELECT `kodebrg`, `nama`, `harga` FROM `barang` WHERE '.$where;
			return $this->db->execRawQ('SELECT `kodebrg`, `nama`, `harga` FROM `barang` WHERE '.$where, $iterateFunc);
		}
		
		/**
			Method Utama
		**/
		public static function mainApp()
		{
			$app = new App();
		
			include 'application/templates/header1.php';
			include 'application/views/cart.php';
			include 'application/templates/footer1.php';
		}
		
	}

?>