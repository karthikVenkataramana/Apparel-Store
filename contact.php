<?php  
  if(session_status()!=PHP_SESSION_ACTIVE)
  session_start();
  include_once('php/css.php'); 
  include_once('php/js.php'); 
  include_once('php/connections.php');
  include_once('php/customers.php');
  include_once('php/validations.php');
 $message_status = array("Name" => "Ok" , "Email" => "Ok");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
      insertmessage();
  } 
  
  function insertmessage(){
  global $message_status;
  if(isset($_POST["message"]) && isset($_POST["captcha"])){
    $username = strip_input($_POST['name']);
    $email = strip_input($_POST['email']);
    $message = strip_input($_POST['message']);
    $captcha = strip_input($_POST["captcha"]);
    }
    
    if(strcmp($captcha, $_SESSION['digit']) == 0){
    $conn = new Connection();
    $conn_obj = $conn->get_connection_object();
    $contact = new Message($username, $email,$message);
    if((is_valid_user($username)) &
      (is_valid_email($email))){
        $contact -> insertmessage($conn_obj); // Refer customers.php
        $conn -> close_connection();
        header('Location: contact.php');
    } 
    $conn -> close_connection();
    }
    else{
      sleep(2);
    }
	}
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" />
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" />
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
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
     <?php if(isset($_SESSION ["valid"]) ) {?>
     <li class="selected"><a href="home.php">Welcome <?php echo $_SESSION["email"];?></a></li>
     <li ><a href="orders.php">Your orders </a></li> <!-- To Do -->
     <?php }?>
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
          <li class="selected" ><a href="contact.php">Contact Us</a></li>
          <?php if(!isset($_SESSION ["valid"])){?>
          <li><a href="login.php">Login</a></li>
          <?php } else {?>
          <li><a href="php/logout.php">Logout</a></li>
          <?php }?>
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
      <div id="content_header"></div>
    <div id="site_content">
    
      <div id="content">
          <div class="form_settings">
             <h1 style ="margin-left:300px;  margin-top:20px;">Get in Touch!</h1> <br>
             <form action="contact.php" id="contact" method = "post">
            <p><input class="contact" style="margin-left:199px" type="text" name="name" placeholder="Full Name..." /></p>
            <p><input class="contact"style="margin-left:199px" type="text" name="email" value=""  placeholder="Email..."/></p>
            <p><textarea class="contact textarea"style="margin-left:199px" rows="8" cols="50" name="message" placeholder="Enter message..."></textarea></p>
             <br> <br> <h4  style="margin-left:200px;color:black;" > CAPTCHA:  <img src="captcha.php" style="margin-left:20px;" width="120" height="30" border="1" alt="CAPTCHA"> </h4> 
            <br> <p> <input class="contact" type="number" name="captcha" placeholder= "Enter captcha..."  style="margin-left:200px;"/></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" value="submit" /></p>
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
