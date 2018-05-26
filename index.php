<?php
	
	/**
		Aplikasi sebagai Router
		
		@author : Mufid Jamaluddin	
	**/
	$file = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/index';

	$path = realpath('application/controllers/'.$file.'.php');
	
	if($path)
		include $path;
	else
		include 'application/controllers/404.php';
	
	require_once 'library/sessionadapter.php';
	
	App::mainApp();
	
?>