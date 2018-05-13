<?php
    ob_start();
    if(session_status()!=PHP_SESSION_ACTIVE) 
    session_start();
    if(!isset($_SESSION["valid"])){
        session_destroy();
        header('Location: index.php');
    } 
 	include_once('php/connections.php');
    include_once('php/customers.php');
    include_once('php/validations.php'); 
    include_once('php/css.php');
    include_once('php/js.php');
    include_once('php/cart.php');
    include_once('php/orders.php');
 
?>
<!DOCTYPE HTML>
 <html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" /> 
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
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
     <li class="selected"><a href="home.php">Welcome <?php echo $_SESSION["email"];?></a></li>
     <li ><a href="orders.php">Your Orders</a></li> <!-- To Do -->
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
    <div>
    <div id="home_site_content" >
      <form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
        $conn = new Connection();
        $conn_obj = $conn -> get_connection_object();
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM items WHERE id IN (SELECT item_id FROM cart WHERE user_id IN (SELECT id from customers WHERE email = '$email') )";
        $result =  $conn_obj  -> query($sql);
        
        $payment_id = rand(100000, 100000000);
        if($result -> num_rows > 0){  
            echo "<h1 style ='font-size:30px;margin-left:215px; margin-top:30px; color:#000000;'> Thank you for shopping with us!</h1> "; 
            echo "<div style = 'margin-left:350px;margin-top: 60px;'> 
            <p id ='h1form' style ='font-size:20px; color:#000000;'> <u> Order details: </u> </p>  
            <p style ='font-size:20px; color:#000000;'> Payment Identification Number: $payment_id </p> 
           <p id ='h1form' style ='font-size:20px; color:#000000;'> For queries: Contact + 1-(940)-356-1982 (24X7 US Customers only)</p> 
           <p id ='h1form' style ='font-size:20px; color:#000000;'> <u> Items: </u> </p> "; 
           while($row = $result->fetch_array(MYSQLI_NUM)){
                 echo " 
                 <div id = 'itemdiv' style = 'margin-left:150px;margin-top:10px;' >
                 <div>
                 <img style='width:150px;height:200px' src = 'php/get_image.php?id=$row[0]' />
                 </div>
                 <div style = 'margin-left:10px;'>
                 <span style = 'font-size: 14px arial;'>$row[1] </span>
                 </div>
                 <div>
                 <span style = 'font-size: 14px arial;'> &nbsp;&nbsp;&nbsp;Price:$ $row[4]</span>
                 </div>
                 <div> 
                 </div>
                 </div> ";
             }
        }
        
        // Add all items from cart to orders! (Payment authorized).
        $conn = new Connection();
        $conn_obj = $conn -> get_connection_object();
        $order = new Orders();
        $order->insert($conn_obj);
        $conn->close_connection();

        // Remove all items from the cart. (Since they are all now moved to orders).
        $conn = new Connection();
        $conn_obj = $conn -> get_connection_object();
        $cart = new Cart(12812); // Some random value, not used by remove_all function().
        $cart -> remove_all($conn_obj);
        $conn->close_connection();
    }
    header("Location:home.php");
?>