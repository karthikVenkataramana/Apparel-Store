<?php
include_once('connections.php');

class Orders{ 
    private $email; 
    public function __construct(){ 
        $this -> email = $_SESSION["email"];
    }
    public function insert($conn){
        $sql = "INSERT INTO orders(item_id, user_id) 
            SELECT item_id, user_id FROM cart WHERE user_id IN (SELECT ID FROM customers WHERE Email = '$this->email')";
        $result = $conn -> query($sql); // Inserts all rows from cart to orders table for that particular user.
    }
}
?>