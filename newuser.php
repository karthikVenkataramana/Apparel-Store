<?php
 
$registration_status = array("Name" => "Ok" , "Password" =>"Ok", "Email" => "Ok", "Phone_number" => "Ok");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		  include_once('php/connections.php');
  		include_once('php/customers.php');
  		include_once('php/validations.php');
      insert();
  } 
  
  function insert(){
    global $registration_status;
    $conn = new Connection();
    $conn_obj = $conn->get_connection_object();
    $username = strip_input($_POST['username']);
    $password = strip_input($_POST['password']);
    $email = strip_input($_POST['email']);
    $phone_number = strip_input($_POST['phone_number']);
    $address = strip_input($_POST['address']);
    $customer = new Customer($username, $password, $email, $phone_number, $address);
    if((! $customer -> is_present($conn_obj, $username, "Name")) & 
      (!$customer ->is_present($conn_obj, $email, "Email")) &
      (is_valid_user($username)) &
      (is_valid_email($email)) & 
      (is_valid_password($password)) & 
      (is_valid_phone_number($phone_number))){
        $customer -> insert($conn_obj); // Refer customers.php
        $conn -> close_connection();
        header('Location: login.php');
    } 
    $conn -> close_connection();
	}
?>

<!DOCTYPE HTML>
<html>
   <head>
      <title>Apparel Store</title>
      <link rel="shortcut icon" href="images/logo.png" />
      <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
      <link rel="stylesheet" type="text/css" href="style.css" />
   <?php 
  include_once('php/css.php');
  include_once('php/js.php');
  ?>
   </head>
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
         <div id= "top-right">
        <ul id="horizontal-list">
      <li ><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </a></li> 
      </ul>
      </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li class="dropdown">
  <a href="clothing.php"  class="dropbtn">Clothing</a>
  <ul id = "tableMenu" class="dropdown-content">
    <a href="#" style="color:black;">Tops</a>
    <a href="#" style="color:black;">Dresses</a>
    <a href="#" style="color:black;">Pants</a>
    <a href="#" style="color:black;">Jackets</a>
    <a href="#" style="color:black;">Shoes</a>
  </ul>
</li>
          <li><a href="contact.php">Contact Us</a></li>
          <li class="selected"><a href="login.php">Login</a></li>
          <li>
          <form class="form-inline my-2 my-lg-0" action="searchresults.php" method="post" id="search_form">
      <input class="form-control mr-sm-2" name="search_field" type="search" placeholder="Search" aria-label="Search">
      <button id= "searchbtn" class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit"><i class="fa fa-search"></i></button>
    </form>
           </li>
        </ul>
      </div>
      <div id="sale_banner">
      <h2>Hurry order within 24hrs to get 20% off use code:20OFF!</h2>
      </div>
      </div>
            <div id="site_content">
               <div id="content" style="width: 951px">
                  <div class="form_settings">
                  <form action = "newuser.php" method = "post">
                     <h1 style ="margin-left:300px; margin-top:20px;">Register with us!</h1>
                     <br>
                     <p><input class="contact" style="margin-left:199px" type="text" name="username" value="" placeholder ="User Name..." /> 
                     <em style= "color: #ff0033;"><?php $msg =(string) $registration_status["Name"] ; if(strcmp($msg, "Ok")) echo $msg ?> </em></p>
                     <p><input class="contact"style="margin-left:199px" type="text" name="email" value=""  placeholder="Email..."/>
                     <em style= "color: #ff0033;"><?php $msg =(string) $registration_status["Email"] ; if(strcmp($msg, "Ok")) echo $msg ?> </em></p>
                     <p><input class="contact"style="margin-left:199px" type="password" name="password" value=""  placeholder="Password..."/>
                     <em style= "color: #ff0033;"><?php $msg =(string) $registration_status["Password"] ; if(strcmp($msg, "Ok")) echo $msg ?> </em></p>
                     <p><input class="contact"style="margin-left:199px" type="text" name="phone_number" value=""  placeholder="Phone ..."/>
                     <em style= "color: #ff0033;"><?php $msg =(string) $registration_status["Phone_number"] ; if(strcmp($msg, "Ok")) echo $msg ?> </em></p>
                     <p><textarea class="contact textarea"style="margin-left:199px" rows="8" cols="50" name="address" placeholder="Address..."></textarea></p>
                     <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="create" value="Create" /></p>
                 </form>
                  </div>
               </div>
            </div>
            <div id="foot">
               <p><a href="index.php">Home</a> | <a href="contact.php">Contact Us</a> | <a href="login.php">Login</a> </p>
               <p>Copyright &copy; 2018 Group 1. All rights reserved.</p>
            </div>
         </div>
      </body>
   </html>