<?php
ob_start();
if(session_status()!=PHP_SESSION_ACTIVE) 
session_start(); 
include_once('php/connections.php');
include_once('php/customers.php');
include_once('php/validations.php');
include_once('php/js.php');
include_once('php/cart.php');
include_once('php/orders.php'); 
$type= $_SESSION["type"];
if (!empty($_POST)) { // On Add to Cart() button clicked.
  if(!isset($_SESSION ["valid"])){
    session_unset();
    session_destroy();
    echo "<script type ='text/javascript'> alert('You have to log in first!');
              window.location.replace('login.php');
            </script>";
  } 
  else { 
    $conn = new Connection();
    $conn_obj = $conn -> get_connection_object();
    foreach ($_POST as $name => $value){
        // Insert into database here. (item_id and user_id).
        $name = (int)$name;
        $cart = new Cart($name); // name is item_id.
        $cart -> insert($conn_obj);
        $cart -> update_item($conn_obj);
        break;
    }
    $conn -> close_connection();
    }
}
?>
<script type="text/javascript">
    function add_item(){
    	alert('Item Added to Cart');
    } 
</script>
<!DOCTYPE HTML>
<html>

<head>
  <title>Apparel Store</title>
  <link rel="shortcut icon" href="images/logo.png" /> 
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style.css" />
<?php
include_once('php/css.php');
?>
</head>

<body >
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
          <li ><a href="index.php">Home</a></li>
          <li class="dropdown">
  <a href="clothing.php" class="selected dropbtn">Clothing</a>
  <ul id = "tableMenu" class="dropdown-content">
       <a href="#" style="color:black;">Tops</a>
    <a href="#" style="color:black;">Dresses</a>
    <a href="#" style="color:black;">Pants</a>
    <a href="#" style="color:black;">Jackets</a>
    <a href="#" style="color:black;">Shoes</a>
  </ul>
</li>
          <li><a href="contact.php">Contact Us</a></li>
          <?php if(!isset($_SESSION ["valid"]) ){?>
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
    <div class="col-md-2" style="margin-top: 40px; left: 1000px;">
  		<tr>
  <td>Sort by</td>
  <td><select name="sort" onchange="sort(this.value)">
  <option value="H2L">High to Low</option>
  <option value="L2H">Low to High</option>
  </select>
  </td>
  </tr>
  </div>
  <div class ="panel">
 <div class ="panel-heading">
 <strong>Refine by</strong>
 </div>
		   <div class ="panel-body">
			<h3> color</h3>
			<div class="checkbox" style="margin-top: -20px;">
            <label><input type="checkbox" value="Black" onclick="check(this.value)">Black</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="White" onclick="check(this.value)">White</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Grey" onclick="check(this.value)" >Grey</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Blue" onclick="check(this.value)">Blue</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Pink" onclick="check(this.value)">Pink</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Green" onclick="check(this.value)">Green</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Yellow" onclick="check(this.value)">Yellow</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Red" onclick="check(this.value)">Red</label>
            </div>
            <div class="checkbox">
            <label><input type="checkbox" value="Orange" onclick="check(this.value)">Orange</label>
            </div>
            </div>
            </div>
 <form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
  <div id="all">
           <?php
           $conn = new Connection();
           $conn_obj = $conn -> get_connection_object();
            $sql = "SELECT * FROM items WHERE Type ='$type' AND Quantity != 0 ORDER BY Price ASC";
            $result =  $conn_obj  -> query($sql);
		    if($result -> num_rows > 0){  
                while($row = $result->fetch_array(MYSQLI_NUM)){
                    echo " 
                    <div id = 'itemdiv'>
                    <div>
                    <img style='width:150px;height:200px' src = 'php/get_image.php?id=$row[0]' />
                    </div>
                    <div style = 'margin-left:10px;'>
                    <span style = 'font-size: 14px arial;'><b>$row[1]</b> </span>
                    </div>
                    <div>
                    <span style = 'font-size: 14px arial;'> &nbsp;&nbsp;&nbsp;<b><u>Price</u></b>: $row[4]$</span>
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
           ?>
    </div>
    </form>
    </div>
    <div id="footer">
      <p><a href="index.php">Home</a> | <a href="contact.php">Contact Us</a> | <a href="login.php">Login</a> </p>
      <p>Copyright &copy; 2018 Group 1. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
