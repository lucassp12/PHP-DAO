<?php

class Sql extends PDO{

	private $conn;
	private $usuario = "root";
	private $password = "";


	public function __construct(){
		$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost",$this->usuario,$this->password);
	}

	private function setParams($stmt, $parameters = array()){
			foreach($parameters as $key => $value){

			$this->setParam($stmt, $key, $value);

	}

}


	private function setParam($stmt, $key, $value){
		$stmt->bindParam($key, $value);

	}

	public function query($rowQuery, $params = array()){
		$stmt = $this->conn->prepare($rowQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

		}

	public function select($rowQuery, $params = array()):array{
		$stmt = $this->query($rowQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
	}

?>