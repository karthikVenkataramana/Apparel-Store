<?php
 ob_start();
 if(session_status()!=PHP_SESSION_ACTIVE) session_start(); 
 if(!isset($_SESSION["valid"])){
    session_destroy();
    header('Location: index.php');
  } 
  include_once('php/js.php');
  include_once('php/connections.php');
  include_once('php/customers.php');
  include_once('php/validations.php'); 
  include_once('php/css.php');
  include_once('php/js.php');
 
?>
 <!DOCTYPE HTML>
 <html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" /> 
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style.css" />
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
     <?php if(isset($_SESSION ["valid"])){?>
     <li><a href="home.php">Welcome <?php echo $_SESSION["email"];?></a></li>
     <li  ><a href="orders.php" class="selected">Your orders </a></li> <!-- To Do -->
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
    <div id="home_site_content">
      <form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
           <?php
           $conn = new Connection();
           $email = $_SESSION["email"];
           $conn_obj = $conn -> get_connection_object();
            $sql = "SELECT * FROM items WHERE id IN 
            (SELECT item_id from orders WHERE user_id IN
              (SELECT ID FROM customers where Email = '$email') )";
            $result =  $conn_obj  -> query($sql);

		        if($result -> num_rows > 0){  
              echo "<h1 id ='h1form' style ='font-size:30px; margin-left:225px; margin-top:30px;'> Items you ordered: </h1> "; 
                while($row = $result->fetch_array(MYSQLI_NUM)){
                    echo " 
                    <div style='border:1px solid #E5E5DB;float:left; margin:25px 0px 10px 25px;'>
                    <div style = 'margin-left:10px;'>
                    <span style = 'font: 180% arial;'>$row[1] </span>
                    </div>
                    <div>
                    <img style='width:200px;height:225px' src = 'php/get_image.php?id=$row[0]' />
                    </div>
                    <div >
                    <span style = 'font: 160% arial;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: $row[4]$</span>
                    <br>
                    </div>
                    </div>";
                }
            }
            else {
              echo "<h1 id ='h1form' style ='font-size:30px; margin-top:50px; margin-left:250px;height:150px; color:#000000;'> No orders yet :(</h1> "; 
            }
           ?>
           </form>
    </div>
    <div id="foot">
      <p><a href="index.php">Home</a> | <a href="contact.php">Contact Us</a> | <a href="login.php"> Login</a> </p>
      <p>Copyright � 2018 Group 1. All rights reserved.</p>
    </div>
    </div>
</body>
</html>

