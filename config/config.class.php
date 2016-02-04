<?php

class config{
	
	//////////////////////
	// variable			//
	//////////////////////
	
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "test";
	
	//////////////////////
	// functions		//
	//////////////////////
	
	function getMysqlHost(){
		return $this->host;
	}
	
	function getMysqlUser(){
		return $this->user;
	}
	
	function getMysqlPassword(){
		return $this->password;
	}
	
	function getMysqlDatabase(){
		return $this->database;
	}
	
	function setMysqlHost($name){
		$this->host = $name;
	}
	
	function setMysqlUser($name){
		$this->user = $name;
	}
	
	function setMysqlPassword($name){
		$this->password = $name;
	}
	
	function setMysqlDatabase($name){
		$this->database = $name;
	}

}

?>