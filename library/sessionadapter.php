<?php
	/**
		Class SessionAdapter dibuat sebagai adapter session php
		
		@author Mufid Jamaluddin
	**/
	namespace MufidJ\Lib;
	
	class SessionAdapter
	{
		/**
			Aktivasi session jika sebelumnya belum pernah dimulai
		**/
		public static function start()
		{
			if (session_status() == PHP_SESSION_NONE) 
			{
				session_start();
			}
		}
		
		/**
			Mendapatkan Reference dari Session
		**/
		public static function getSession()
		{
			SessionAdapter::start();
			$sess = &$_SESSION;
			return $sess;
		}
		
		/**
			Menghapus semua session
		**/
		public static function destroy()
		{
			SessionAdapter::start();
			session_destroy();
		}
	}
	
?>