<?php 

class Connection{
  private $conn;
  private $host = "localhost";
  private $username = "id5744267_root" ;
  private $password = "apparelstore";
  private $db_name = "id5744267_apparel_store"; // Name of database	
  public function __construct(){
    $this ->conn = new mysqli($this -> host, $this -> username, $this -> password, $this -> db_name);
  }
  public function close_connection(){
 	$this -> conn -> close();
  }
  public function get_connection_object(){
 	return $this->conn;
 }
}

