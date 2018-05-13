<?php
include_once('connections.php');
// Deals with the cart table in database.
class Cart{
    private $item_id; 
    private $email; 
    public function __construct($item_id){
        $this -> item_id = $item_id; 
        $this -> email = $_SESSION["email"];
    }
    public function get_total($conn){
        $sql = "SELECT SUM(PRICE) FROM items WHERE id IN 
                    (SELECT item_id FROM cart WHERE user_id =  
                                (SELECT ID FROM customers WHERE Email = '$this->email'))";
        $stmt =  $conn-> prepare($sql);
	    $result = $stmt -> execute(); // Insert into the database.
	    $stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!  
        $stmt -> bind_result($count);
        $stmt -> fetch(); 
        return $count;
    }
    public function remove($conn){
        $sql = "DELETE FROM cart WHERE item_id = ? AND user_id = (SELECT ID FROM customers WHERE Email = '$this->email') "; 
		if($stmt =  $conn-> prepare($sql)){
			$stmt -> bind_param("d", $this -> item_id); // s for string, d for int.
	   }else{
			 echo "Died due to ". $conn -> error;
	   }
	   $result = $stmt -> execute(); // Insert into the database.
	   $stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!  
	   echo "<script type ='text/javascript'> alert('Item removed!'); </script>";
     }

    public function remove_all($conn){
        $sql = "DELETE FROM cart WHERE user_id = (SELECT ID FROM customers WHERE Email = '$this->email') "; 
	    $result = $conn -> query($sql); // Delete every entry from cart of that particular customer.
    }
    public function update_item($conn){
        $sql = "UPDATE items SET Quantity = Quantity - 1 WHERE id = ? ";
        if($stmt =  $conn-> prepare($sql)){
            $stmt -> bind_param("d", $this -> item_id); // s for string, d for int.
        }else{
            echo "Died due to ". $conn -> error;
        }
        $result = $stmt -> execute(); // Insert into the database.
        $stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!
    }
    public function add_back($conn){
        $sql = "UPDATE items SET Quantity = Quantity + 1 WHERE id = ? ";
        if($stmt =  $conn-> prepare($sql)){
            $stmt -> bind_param("d", $this -> item_id); // s for string, d for int.
        }else{
            echo "Died due to ". $conn -> error;
        }
        $result = $stmt -> execute(); // Insert into the database.
        $stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!
    }
    public function insert($conn){
        $sql = "SELECT * FROM cart WHERE item_id =  ? and user_id = (SELECT ID FROM customers WHERE Email = '$this->email')"; // Any vulnerability here? // To - Do
		if($stmt =  $conn-> prepare($sql)){
			$stmt -> bind_param("d", $this -> item_id); // s for string, d for int.
	   }else{
			 echo "Died due to ". $conn -> error;
	   }
	   $result = $stmt -> execute(); // Insert into the database.
	   $stmt->store_result(); //store_result() "binds" the last given answer to the statement-object for... reasons. Now we can use it!  
       if($stmt-> num_rows == 0){ // No entry in cart database.
            $sql = "INSERT INTO cart(item_id, user_id) VALUES (?, (SELECT ID FROM customers WHERE Email = '$this->email'))";
            if($stmt =  $conn-> prepare($sql)){
                $stmt -> bind_param("d", $this -> item_id); // s for string, d for int.
            }else{
                echo "Died due to ". $this -> conn -> error;
            }
            $stmt -> execute(); // Insert into the database.
            $stmt -> close();
            echo "<script type ='text/javascript'> alert('Item added to cart successfully!'); </script>"; 
        }
        else{
            //echo "<script type ='text/javascript'> alert('Sorry, item already in the cart!'); </script>"; 
        }
    }
} 
?>