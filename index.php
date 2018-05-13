<?php  
  if(session_status()!=PHP_SESSION_ACTIVE) 
    session_start();
  if(isset($_SESSION["valid"])){
      header('Location: home.php');
  }
  if(isset($_SESSION["admin"])){
    session_destroy();
  }
  include_once('php/connections.php');
  include_once('php/customers.php');
  include_once('php/validations.php'); 
  if($_SERVER['HTTPS']!= "on") { 
    $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];header("Location:$redirect"); 
  } 
  $newsletter_status = array("Name" => "Ok" , "Email" => "Ok");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		  include_once('php/connections.php');
  		include_once('php/customers.php');
  		include_once('php/validations.php');
      insertnews();
    } 
  
  function insertnews(){
    global $newsletter_status;
    $conn = new Connection();
    $conn_obj = $conn->get_connection_object();
    $username = strip_input($_POST['username']);
    $email = strip_input($_POST['email']);
    $newsletter = new Newsletter($username, $email);
    if((is_valid_user($username)) &
      (is_valid_email($email))){
        $newsletter -> insertnews($conn_obj); // Refer customers.php
        $conn -> close_connection();
        header('Location: index.php');
    } 
    $conn -> close_connection();
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
  <?php 
  include_once('php/css.php');
  include_once('php/js.php');
  ?>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <h1><a href="index.php">Apparel Store</a></h1>
          <h2>Be simple, be stylish!</h2>
        </div>
        <div id= "top-right">
        <ul id="horizontal-list">
         <?php if(isset($_SESSION ["valid"]) ){?>
     <li class="selected"><a href="home.php">Welcome <?php echo $_SESSION["email"];?></a></li>
     <li ><a href="orders.php">Your orders </a></li> <!-- To Do -->
     <?php }?>
      <li ><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> </a></li> 
      </ul>
      </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li class="selected" ><a href="index.php">Home</a></li>
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
     <div id="site_content">  
 <div class="carousel-wrapper">
  <span id="item-1"></span>
  <span id="item-2"></span>
  <span id="item-3"></span>
  <div class="carousel-item item-1">
   <a class="arrow arrow-prev" href="#item-3"></a>
    <a class="arrow arrow-next" href="#item-2"></a>
  </div>
  
  <div class="carousel-item item-2">
   <a class="arrow arrow-prev" href="#item-1"></a>
    <a class="arrow arrow-next" href="#item-3"></a>
  </div>
  
  <div class="carousel-item item-3">
    <a class="arrow arrow-prev" href="#item-2"></a>
    <a class="arrow arrow-next" href="#item-1"></a>
  </div>
</div>
	
      <div id="content">
        <!-- insert the page content here -->
        
        <h1>Welcome to the Apparel store</h1>
        <p>All about that new? We got you girl. Apparel store is your one-stop shop for trend led women's clothing at seriously killer prices.</p>
        <p>Whether you want the freshest threads straight off the runway, or to steal the style of your fave celeb muse of the moment, at PrettyLittleThing USA we've got you covered with everything you need to keep your style on-point..</p>
        <p>When it comes to serving you the latest dose of women's fashion, we've got hundreds of new product dropping daily for everything your #OOTD needs..</p>
        <p> This is fast fashion accelerated. Too well dressed to stress? Now you are.</p>
   <form action="index.php" id="newsletter" method = "post">
  <div class="container">
    <h2>Subscribe to our Newsletter</h2>
  </div>

  <div class="container" style="background-color:white">
    <input type="text" id = "newsname" placeholder="Name" name="username" required>
    <input type="text" id = "newsemail" placeholder="Email address" name="email" required>
    <label>
      <input type="checkbox" id ="newscheck" checked="checked" name="subscribe"> Daily Newsletter
    </label>
  </div>

  <div class="container">
    <input type="submit" id ="newssub" value="Subscribe">
  </div>
</form>
      </div>
    </div>
    <div id="footer">
      <p><a href="index.php">Home</a> | <a href="contact.php">Contact Us</a> | <a href="login.php">Login</a> </p>
      <p>Copyright &copy; 2018 Group 1. All rights reserved.</p>
    </div>
  </div>
 
</body>
</html>
