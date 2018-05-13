<?php
include_once('connections.php');
class Items{
    private $name;
    private $image;
    private $type;
    private $price;
    private $quantity;
    private $color;
    private $description;
    public function __construct($name, $type,  $image, $price,$color,  $quantity, $description){
        $this -> name = $name;
        $this -> type = $type;
        $this -> image = $image;
        $this -> price = $price;
        $this -> color = $color;
        $this -> quantity = $quantity;
        $this -> description = $description;
    }
    public function insert($conn){
        $name = $this -> name;
        $type = $this -> type;
        $image = $this -> image;
        $price = $this -> price;
        $quantity = $this ->quantity;
        $color = $this -> color;
        $description = $this -> description;
        $sql = "INSERT INTO items (Name, Type, Image, Price, Colour, Quantity, Description) VALUES ('$name', '$type',  '$image', '$price','$color', '$quantity', '$description' )"; // A Prepared statement to prevent SQL Injection!
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } 
    }

}
?>