<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if(!isset($_SESSION)){ 
session_start();
}
include_once('php/connections.php');
include_once('php/customers.php');
include_once('php/validations.php');
include_once('php/css.php');
include_once('php/js.php'); 
$color= $_GET['color']; 
echo  "<h3>Selected: $color </h3>";
$type= $_SESSION['type'];
$conn = new Connection();
$conn_obj = $conn -> get_connection_object(); 
    $sql = "SELECT * FROM items WHERE Type = '$type' AND Quantity != 0 AND Colour = '$color'";
    $result =  $conn_obj  -> query($sql);
    if($result -> num_rows > 0) {
        while($row = $result->fetch_array(MYSQLI_NUM)){
            echo "
                    <div id = 'itemdiv'>
                    <div>
                    <img style='width:150px;height:200px' src = 'php/get_image.php?id=$row[0]' />
                    </div>
                    <div style = 'margin-left:10px;'>
                    <span style = 'font-size: 14px arial;'>$row[1] </span>
                    </div>
                    <div>
                    <span style = 'font-size: 14px arial;'> &nbsp;&nbsp;&nbsp;Price:$ $row[4]</span>
                    </div>
                    <div style = 'margin-left:10px;'>
                    <span style = 'font-size: 10px arial;'><b><u>Description</u></b>: $row[7] </span>
                    </div>
                    <div>
                    <input id ='addtocart' type = 'submit' ' name ='$row[0]' value = 'Add to Cart'/>
                    </div>
                    </div> ";
        }
    }
    else{
        echo " <div> 
                <h1> No Products within selected category </h1>
                </div>";
    }

  

 ?>
</body>
</html>