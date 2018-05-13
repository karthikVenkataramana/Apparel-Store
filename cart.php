<?php
    ob_start();
    if(session_status()!=PHP_SESSION_ACTIVE) session_start(); 
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
 
    if (!empty($_POST)) { // On Add to Cart() button clicked.
        $conn = new Connection();
        $conn_obj = $conn -> get_connection_object();
        foreach ($_POST as $name => $value){  // name is item_id.
          // Insert into database here.
          $name = (int)$name;
          $cart = new Cart($name);
          $cart -> remove($conn_obj);
          $cart -> add_back($conn_obj);
          break;
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
    <div>
    <div id="home_site_content" >
      <form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
            
           <?php
           $conn = new Connection();
           $conn_obj = $conn -> get_connection_object();
           $email = $_SESSION['email'];
            $sql = "SELECT * FROM items WHERE id IN (SELECT item_id FROM cart WHERE user_id IN (SELECT id from customers WHERE email = '$email') )";
            $result =  $conn_obj  -> query($sql);
		    if($result -> num_rows > 0){  
                echo "<h1 style ='font-size:30px;margin-left:215px; margin-top:20px; color:#000000;'> Items in your cart: </h1> "; 
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
                    <div>
                    <input id ='removefrmcart' type = 'submit' name ='$row[0]' value = 'Remove from Cart'/>
                    </div>
                    </div> ";
                }
            }
            else{
                echo "<br><br><br><h1 id ='h1form' style ='font-size:30px; margin-left:350px;height:70px; color:#000000;'>  Your cart looks empty :(</h1> "; 
            }
           ?>
           </form>
    </div>
    <div style ="margin-left: 450px;margin-top:45px;float:left;">
        <span style ="font-size:22px;">Running Total: </span> <span id = "total"/>
        <?php 
          $conn = new Connection();
          $conn_obj = $conn -> get_connection_object();
          $cart = new Cart(18021); // Some random value
          $_SESSION["total"] = $cart -> get_total($conn_obj);
          echo " <span style = 'font-size:22px;' >".(string) ($cart -> get_total($conn_obj)) ."$ &nbsp;&nbsp;&nbsp; </span>" ;
          $conn -> close_connection();
        ?> 
        </div>
        <div id="paypal-button" style = "margin-top: 25px;">
    <br>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({

        env: 'sandbox', // Or 'sandbox'
        style: {
            size: 'medium',
            color: 'blue',
            shape: 'pill',
            label: 'checkout'
        },
        funding: {
            allowed: [ paypal.FUNDING.CARD ]

        },
        payer: {
            payment_method: 'paypal',
        },
        client: {
            sandbox:    'AbfeQ0viWh8rMwYGBWljXgdkaimzi8WWwtDnHDyuEBAihf9m-dnBLJOjv28grhocF6iNQrCkm8p2cOO1'
        },
        commit: true, // Show a 'Pay Now' button
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $_SESSION["total"]?>' , currency: 'USD' }  
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {
                 window.location = 'insert_order.php'; // The payment is complete! 
            });
        }

    }, '#paypal-button');
</script>
</div>
<img src ="images/prote.jpg"  style ="margin-left:550px;height:150px;width:150px;"alt = "We are secured" />
    </div> 
    <div id="foot">
      <p><a href="index.php">Home</a> | <a href="contact.php">Contact Us</a> | <a href="login.php"> Login</a> </p>
      <p>Copyright � 2018 Group 1. All rights reserved.</p>
    </div>
    </div>
</body>
</html>

