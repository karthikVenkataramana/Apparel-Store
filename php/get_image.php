<?php

require_once('connections.php');
require_once('validations.php');
header("content-type:image/jpeg");
$conn = new Connection();
$conn_obj = $conn -> get_connection_object();
$name= strip_input($_GET['id']);
if(is_numeric($name)){
  $sql= "select * from items where id='$name'";
  $var= $conn_obj -> query($sql);
  if($row = mysqli_fetch_array($var, MYSQLI_ASSOC)){
    $image_name=$row["Name"];
    $image_content=$row["Image"];
 }
}
echo $image_content;

?>