<?php

 ob_start();
 if(session_status()!=PHP_SESSION_ACTIVE) session_start(); 
 
  $login_status = "OK"; 
 
  if(!isset($_SESSION["admin"])){
    session_destroy();
    header('location: index.php');
  }
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		include_once('php/connections.php');
  	include_once('php/customers.php');
    include_once('php/validations.php');
    include_once('php/items.php');
  	insert();
  } 
  function insert(){
    $conn = new Connection();
    $conn_obj = $conn -> get_connection_object();
    $name = strip_input($_POST['name']);
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); // Prevent SQL Injection.
    $price = strip_input($_POST['price']);
    $type = strip_input($_POST['type']);
    $color = strip_input($_POST['color']);
    $quantity = strip_input($_POST['quantity']);
    $description = strip_input($_POST['description']);
    $item = new Items($name, $type,  $image, $price, $color, $quantity, $description); 
    $item -> insert($conn_obj);
    $conn -> close_connection();
    alert("Succesfully Inserted!"); 
  }
  function alert($msg) { 
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
?>

 <!DOCTYPE HTML>
 <html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" /> 
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body style="background-image:url('images/background.jpg'); float:inherit">
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <h1><a href="index.php">Apparel Store</a></h1>
          <h2>Be simple, be stylish!</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
        <li> <a href = "" >Welcome Admin!</a></li>
        <li> <a href = "index.php" >Logout</a></li>
        </ul>
      </div>
    </div>    <div id="content_header"></div>
    <div id="site_content">
    
      <div id="content">
          <div class="form_settings">
             <h1 style ="margin-left:300px;">Add Items</h1> <br>
             <form action="admin.php" method="post" enctype="multipart/form-data">
             <p> <input  type="text" name="name"   placeholder="Name..."  style="margin-left:200px;" /></p>
            <p> <input type="file" name="image" style="margin-left:200px;"/></p>
            <p> <input  type="text" name="type"   placeholder= "Type..."  style="margin-left:200px;" /></p>
            <p> <input  type="text" name="price"   placeholder="Price..."  style="margin-left:200px;" /></p>
            <p> <input  type="text" name="color"   placeholder="Color..."  style="margin-left:200px;" /></p>
            <p> <input  type="text" name="quantity"   placeholder="Quantity..."  style="margin-left:200px;" /></p>
            <p> <input  type="text" name="description"   placeholder="Description..."  style="margin-left:200px;" /></p>

            <p style="padding-top: 15px"> 
            <input class="submit" type="submit" name="insert" value="Insert" style="margin-left:300px;"/></p>
            </form>
             </div>       
      </div>
    </div>
    <div id="foot">
      <p  style ="margin-left:250px;">Copyright 2018 Group 1. All rights reserved.</p>
    </div>
    </div>
</body>
</html>

