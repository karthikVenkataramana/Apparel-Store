<?php
include_once('connections.php');
$login_status = "OK";
class Customer{
	private $name;
	private $password;
	private $email;
	private $phone_number;
	private $address;
	public function __construct($name, $password, $email, $phone_number, $address){
		$this -> name = $name;
		$this -> password = $password;
		$this -> email = $email;
		$this -> phone_number = $phone_number;
		$this -> address = $address;
	}
	public function insert($conn){
		$sql = "INSERT INTO customers (Name, Password, Email, Phone_number, Address) VALUES (?,?,?,?,?)"; // A Prepared statement to prevent SQL Injection!
		if($stmt =  $conn-> prepare($sql)){
    	 	$stmt -> bind_param("sssds",$this -> name, md5($this -> password),$this -> email,$this -> phone_number,$this -> address ); // s for string, d for int.
    	}else{
      		echo "Died due to ". $this -> conn -> error;
    	}
    	$stmt -> execute(); // Insert into the database.
    	$stmt -> close();
	}
	public static function authenticate($conn, $value,  $password){
		global $login_status;
		$sql = "SELECT * FROM customers WHERE Email = '$value' and Password = '$password' and ID = 1 "; // Any vulnerability here? // To - Do
  		$result =  $conn -> query($sql);
  		if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
		if($result -> num_rows > 0){ // Successful Admin login.
			$_SESSION["admin"] = "active";
    		Customer::redirect('admin.php');
    	}
  		else{ // Normal User
			$sql = "SELECT * FROM customers WHERE Email= '$value' and Password = '$password'";
			$result =  $conn -> query($sql);
			 if (!$result) {
                trigger_error('Invalid query: ' . $conn->error);
            }
			if($result -> num_rows > 0){ // Successful login.
			$_SESSION["valid"] = "true";
			$_SESSION["email"] = $value;
			echo " Here ";
			Customer::redirect('home.php');
		  	echo " Redirect did not work";
			    
			}
			$login_status  = "Invalid Username or Password";
		  }
	}
	public static function redirect($url, $permanent = false){
    	if (headers_sent() === false){
    	    $url = 'Location: ' . $url;
    	    ob_start();
            header($url , true, ($permanent === true) ? 301 : 302);
    	}
        exit();
	}

	public function is_present($conn, $row , $attribute){
		global $registration_status;
		$sql = "SELECT * FROM customers where $attribute = '$row'";
		$result = $conn -> query($sql);
		if($result -> num_rows > 0){ 
			$registration_status[$attribute] = $attribute. " is already exists!";
			return true;
		}
		return false;
	  }
}
?>
