<?php

	/**
		Aplikasi sebagai kelas utama
		
		@author : Mufid Jamaluddin	
	**/
	class App
	{
		
		/**
			Method Utama
		**/
		public static function mainApp()
		{
			include 'application/templates/header1.php';
			include 'application/views/404.php';
			include 'application/templates/footer1.php';
		}
		
	}

?>