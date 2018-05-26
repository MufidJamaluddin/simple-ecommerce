<?php

	/**
		File ini dibuat bertujuan untuk akses database
		
		@author : Mufid Jamaluddin	
	**/
	namespace MufidJ\Lib;
	
	/**
		Class Konfigurasi untuk akses database 
	**/
	class DbConfig
	{
		const servername = 'localhost';
		const username = 'root';
		const password = ''; 
		const dbname = 'dbcart2';
	}

	/**
		Class untuk akses database
	**/
	class DbAdapter
	{
		/**
			Koneksi Database
		**/
		private $conn;
		
		/**
			Destruktor
			Menutup Koneksi 
		**/
		function __destruct()
		{
			if(isset($this->conn)) 
				$this->conn->close();
		}
		
		/**
			Mendapatkan Koneksi.
			Jika koneksi belum ada, maka akan melakukan instansiasi koneksi mysqli.
		**/
		public function getConnection()
		{
			if(isset($this->conn) and $this->conn != false)
				return $this->conn;
			
			$this->conn = new \mysqli(DbConfig::servername, DbConfig::username, DbConfig::password, DbConfig::dbname);
			
			if($this->conn->connect_error)
			{
				die($this->dbconf::$conn_failed . $conn->connect_error);
			}
			
			return $this->conn;
		}
		
		/**
			Eksekusi Raw Query
			Hasilnya object
		**/
		public function execRawQ($query, $iterateFunc)
		{
			$count = 0;
			$result = $this->getConnection()->query($query);
			
			while($obj = $result->fetch_object())
			{
				$count++;
				$iterateFunc($count, $obj);
			}
			
			$result->close();
		}
		
		/**
			Eksekusi Bind Parameter dg PreparedStatement
		**/
		public function execBindQ($query, $values, $iterateFunc)
		{
			$stmt = $this->getConnection()->prepare($query);
			
			foreach($values as $key => $value)
			{
				$stmt->bindValue($key, $value);
			}
			
			$result = $stmt->get_result();
			
			while($obj = $result->fetch_object())
			{
				$count++;
				$iterateFunc($count, $obj);
			}
			
			$stmt->close();
			
			$result->close();
		}
		
		/**
			Mendapatkan hasil raw query
			bentuk array
		**/
		public function getArrRawQ($query)
		{
			$result = $this->getConnection()->query($query);
			
			while($obj = $result->fetch_object())
			{
				$arr_obj[] = $obj;
			}
			
			$result->close();
			
			if(isset($arr_obj))
				return $arr_obj; 
			else
				return array();
		}
		
		/**
			Mendapatkan Hasil Query dg PreparedStatement
		**/
		public function getArrBindQ($query, $values)
		{	
			$stmt = $this->getConnection()->prepare($query);
			
			foreach($values as $key => $value)
			{
				$stmt->bindValue($key, $value);
			}
			
			$result = $stmt->get_result();
			
			while($obj = $result->fetch_object())
			{
				$arr_obj[] = $obj;
			}
			
			$result->close();
			
			$stmt->close();
			
			if(isset($arr_obj))
				return $arr_obj; 
			else
				return array();
		}
		
		/**
			Mendapatkan Affected Rows dari Query
		**/
		public function getRawAffRows($query)
		{
			$this->getConnection()->query($query);
			return $this->conn->affected_rows;
		}
		
		/**
			Mendapatkan Affected Rows dg PreparedStatement
		**/
		public function getBindAffRows($query, $values)
		{
			$conn = $this->getConnection();
			$stmt = $conn->prepare($query);
			
			foreach($values as $key => $value)
			{
				$value = (string) $value;
				$refval = &$value;
				$stmt->bind_param(":$key", $refval);
			}
			
			$stmt->execute();
			
			$affected_rows = $stmt->affected_rows;
			
			//$stmt->close;
			
			return $affected_rows;
		}
		
	}

?>