<?php 
 ob_start();
 if(session_status()!=PHP_SESSION_ACTIVE) session_start(); 
 ?>
 <?php   
  $login_status = "OK";
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 
		  include_once('php/connections.php');
  		include_once('php/customers.php');
      include_once('php/validations.php');
  		login();
  }
	function login(){
  		global $login_status;
  		if(isset($_POST["email"]) && isset($_POST["captcha"])){
        $email = strip_input($_POST["email"]); // Strips and trims user entered email address(See validations.php)
        $captcha = strip_input($_POST["captcha"]);
      }
    if(strcmp($captcha, $_SESSION['digit']) == 0){
      $password = md5($_POST["password"]);
      $conn = new Connection(); 
      $conn = $conn->get_connection_object();
      Customer::authenticate($conn, $email, $password);
    }
    else{
      sleep(2);
    }
	}
	include_once('php/css.php');
	include_once('php/js.php');
	
?>

 <!DOCTYPE HTML>
 <html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" />
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" /> 
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
          <li class="selected" ><a href="login.php">Login</a></li>
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
             <h1 style ="margin-left:300px; margin-top:20px;">Login Form</h1> <br>
             <form action="login.php" method="post">
            <p> <input  type="text" name="email"   placeholder="Email..."  style="margin-left:200px;" /></p>
            <p> <input class="contact" type="password" name="password" placeholder="Password.."  style="margin-left:200px;"/></p>
            <br> <br> <h4  style="margin-left:200px;color:black;" > CAPTCHA:  <img src="captcha.php" style="margin-left:20px;" width="120" height="30" border="1" alt="CAPTCHA"> </h4> 
            <br> <p> <input class="contact" type="number" name="captcha" placeholder= "Captcha.."  style="margin-left:200px;"/></p>
            <h4  style="margin-left:200px;color:red;" > <?php $msg = $login_status; if(strcmp($msg, "OK")) echo $msg  ?> </h4>
             <p style="padding-top: 15px"> 
           <input class="submit" type="button" name="new_user" onclick="document.location.href='newuser.php'"  style="margin-left:200px;" value="New User?"  />
           <input class="submit" type="submit" name="login" value="login" /></p>
            
            </form>
             </div>       
      </div>
    </div>
    <div id="foot">
      <p><a href="index.php">Home</a> | <a href="contact.php">Contact Us</a> | <a href="login.php"> Login</a> </p>
      <p>Copyright � 2018 Group 1. All rights reserved.</p>
    </div>
    </div>
</body>
</html>

