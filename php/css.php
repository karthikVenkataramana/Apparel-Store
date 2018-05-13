<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

 .carousel-wrapper{
  height:400px;
  position:relative;
  width:800px;
  margin:0 auto;
}
.carousel-item{
  position:absolute;
  top:80px;
  bottom:0;
  left:0;
  right:0;
  padding:25px 50px;
  opacity:0;
  transition: all 0.5s ease-in-out;
}
.arrow{
  position:absolute;
  top:0;
  display:block;
  width:50px;
  height:100%;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
  background: url("http://dancort.es/assets/img/css-carousel/carousel-arrow-dark.png") 50% 50% / 20px no-repeat;
}

.arrow-prev{
  left:0;
}
 
.arrow-next{
    right:0;
    -webkit-transform: rotate(180deg);
     transform: rotate(180deg);
  }

.light{
  color:white;
}

@media (max-width: 480px) {
      .arrow, .light .arrow {
        background-size: 10px;
        background-position: 10px 50%;
      }
    }
}

/*Select every element*/
[id^="item"] {
    display: none;
  }

.item-1 {
    z-index: 2;
    opacity: 1;
  background:url('http://s7d9.scene7.com/is/image/TheBay/808_Dresses_Shop_EN_04?qlt=100&scl=1');
  background-size:cover;
  }
.item-2{
  background:url('https://www.islandcompany.com/media/island/splash/slider/mens-cabana-shirts-splash.jpg');
   background-size:cover;
}
.item-3{
  background:url('https://images.milled.com/2014-03-04/quAniwlCT9wVKx99/fKUIodQm2UG7jvKS.jpg');
   background-size:cover;
}

*:target ~ .item-1 {
    opacity: 0;
  }

#item-1:target ~ .item-1 {
    opacity: 1;
  }

#item-2:target ~ .item-2, #item-3:target ~ .item-3 {
    z-index: 3;
    opacity: 1;
  }
}


 
/* Adjust dropdown Menu items (blue) text color, (yellow) shading and (green) border */
.dropdown-menu > li > a {
color:          blue;
background:     yellow;
border-bottom:  2px solid green;

}
 
/* Remove the Hover/Focus Colors  */
.navbar .nav > li.current-menu-item > a, .navbar .nav > li.current-menu-ancestor > a, 
.navbar .nav > li > a:hover, .navbar .nav > li > a:focus {
color:          lightgray;
}
.dropbtn {
    padding: 12px;
    font-size: 16px;
    border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}

html
{ height: 100%;}

*
{ margin: 0;
  padding: 0;}

body
{ font: normal .80em 'trebuchet ms', arial, sans-serif;
  background: #FFF;
  color: #555;}

p
{ padding: 0 0 20px 0;
  line-height: 1.7em;}

img
{ border: 0;}

h1, h2, h3, h4, h5, h6 
{ color: #E7746F;
  letter-spacing: 0em;
  padding: 0 0 5px 0;}

h1, h2, h3
{ font: normal 170% 'century gothic', arial;
  margin: 0 0 15px 0;
  padding: 15px 0 5px 0;}

h2
{ font-size: 160%;
  padding: 9px 0 5px 0;}

h3
{ font-size: 140%;
  padding: 5px 0 0 0;}

h4, h6
{ color: #009FBC;
  padding: 0 0 5px 0;
  font: normal 110% arial;
  text-transform: uppercase;}

h5, h6
{ color: #888;
  font: normal 95% arial;
  letter-spacing: normal;
  padding: 0 0 15px 0;}

a, a:hover
{ outline: none;
  text-decoration: none;
  color: #E7746F;}

a:hover
{ text-decoration: none;}

blockquote
{ margin: 20px 0; 
  padding: 10px 20px 0 20px;
  border: 1px solid #E5E5DB;
  background: #FFF;}

ul
{ margin: 2px 0 22px 17px;}

ul li
{ list-style-type: circle;
  margin: 0 0 6px 0; 
  padding: 0 0 4px 5px;
  line-height: 1.5em;}

ol
{ margin: 8px 0 22px 20px;}

ol li
{ margin: 0 0 11px 0;}

.left
{ float: left;
  width: auto;
  margin-right: 10px;}

.right
{ float: right; 
  width: auto;
  margin-left: 10px;}

.center
{ display: block;
  text-align: center;
  margin: 20px auto;}

#main, #logo, #menubar, #site_content, #footer
{ margin-left: auto; 
  margin-right: auto;
  }

#header
{ background: #1d1d1d url(pattern.png) repeat;
  border-bottom: 2px solid #E7746F;
  height: 177px;}
  
#banner
{ background: transparent url(banner.jpg) no-repeat;
  width: 870px;
  height: 180px;
  margin-bottom: 20px;
  border: 5px solid #E7746F;}
  
  #top-right{
  margin-top: -10px;
  margin-left: 800px;
  position: absolute;
  }
  

  #addtocart {
  background-color: #000000;
  border: none;
  color: white;
  margin:0px 0px 10px 100px;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;'
  height:20px; 
  width:150px; 
  position:relative;
  margin-left: 0px; 
  margin-top: 10px;
  }
  
  #removefrmcart {
  background-color: #000000;
  border: none;
  color: white;
  margin:0px 0px 10px 100px;
  padding: 15px 32px;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;'
  height:20px; 
  width:150px; 
  position:relative;
  margin-left: 0px; 
  margin-top: 10px;
  
  }
  
  #itemdiv {
  width: 200px;
  height: 320px;
  margin:25px 0px 10px 25px;
  float:left;
  border:1px solid #E5E5DB;
  }
  ul#horizontal-list {
	min-width: 696px;
	list-style: none;
	list-style-type: none;
	padding-top: 20px;
	}


ul#horizontal-list li {
	 float: left;
	 display: inline;
	 padding: 0 .5em; 
	 border-left: solid 2px #FFF;
}
ul#horizontal-list li:first-child{
    border-left: none;
}
  #sale_banner, h2
  {
    color: #FFF;
  }
  #sale_banner
  {
  margin-top:-10px;
  width: 100%;
  background: #E7746F repeat; 
  text-align: center;
  }

#logo
{ width: 880px;
  position: relative;
  height: 140px;
  background: transparent;}

#logo #logo_text 
{ position: absolute; 
  top: 10px;
  left: 0;}

#logo h1, #logo h2
{ font: normal 300% 'century gothic', arial, sans-serif;
  border-bottom: 0;
  text-transform: none;
  margin: 0 0 0 9px;}

#logo_text h1, #logo_text h1 a, #logo_text h1 a:hover 
{ padding: 22px 0 0 0;
  color: #FFF;
  letter-spacing: 0.1em;
  text-decoration: none;}

#logo_text h1 a .logo_colour
{ color: #E7746F;}

#logo_text a:hover .logo_colour
{ color: #FFF;}

#logo_text h2
{ font-size: 120%;
  padding: 4px 0 0 0;
  color: #FFF;}

#menubar
{ width: 880px;
  height: 46px;} 

ul#menu
{ float: right;
  margin: 0;}

ul#menu li
{ float: left;
  padding: 0 0 0 9px;
  list-style: none;
  margin: 1px 2px 0 0;
  background: transparent;
  font: normal 100% 'trebuchet ms', sans-serif;
}

ul#menu li a 
{ font: normal 100% 'trebuchet ms', sans-serif;
  display: block; 
  float: left; 
  height: 20px;
  padding: 6px 35px 5px 28px;
  text-align: center;
  color: #FFF;
  text-decoration: none;
  background: transparent;} 

 


ul#menu li.selected a
{ height: 20px;
  padding: 6px 35px 5px 28px;}

ul#menu li.selected
{ margin: 1px 2px 0 0;
  background: #E7746F;}

ul#menu li.selected a, ul#menu li.selected a:hover
{ background: #E7746F;
  color: #FFF;}

ul#menu li a:hover
{ color: #FFF;
  background: #E7746F;}

#site_content
{ width: 800px;
  overflow: hidden;
  margin: 0px auto 0 auto;
  padding: 0 0 10px 0;} 

#home_site_content
{ width: 1200px;
  overflow: hidden;
  margin: 0px 10px 0 100px;
  padding: 0 0 10px 0;} 

#sidebar_container
{ float: right;
  width: 224px;}

.sidebar_top
{ width: 222px;
  height: 14px;
  background: transparent url(side_top.png) no-repeat;}

.sidebar_base
{ width: 222px;
  height: 14px;
  background: url(side_base.png) no-repeat;}

.sidebar
{ float: right;
  width: 222px;
  padding: 0;
  margin: 0 0 16px 0;}

.sidebar_item
{ background: url(side_back.png) repeat-y;
  padding: 0 15px;
  width: 192px;}

.sidebar li a.selected
{ color: #444;} 

.sidebar ul
{ margin: 0;} 

#content
{ text-align: left;
  width: 820px;
  padding: 0 0 0 5px;
  float: left;}
  
#content ul
{ margin: 2px 0 22px 0px;}

#content ul li, .sidebar ul li
{ list-style-type: none;
  background: url(bullet.png) no-repeat;
  margin: 0 0 0 0; 
  padding: 0 0 4px 25px;
  line-height: 1.5em;}

#footer
{ width: 100%;
  	margin-top: 150px;
  font-family: 'trebuchet ms', sans-serif;
  font-size: 100%;
  height: 80px;
  padding: 28px 0 5px 0;
  text-align: center; 
	background: #1d1d1d url(pattern.png) repeat;
 color: #FFF;}
  
 #foot
 {width: 100%;
  margin-top: 250px;
  font-family: 'trebuchet ms', sans-serif;
  font-size: 100%;
  height: 80px;
  padding: 28px 0 5px 0;
  text-align: center; 
background: #1d1d1d url(pattern.png) repeat;
 color: #FFF;
 
	
}

#footer p
{ line-height: 1.7em;
  padding: 0 0 10px 0;}

#footer a
{ color: #E7746F;
  text-decoration: none;}

#footer a:hover
{ color: #FFF;
  text-decoration: none;}

.search
{ color: #5D5D5D; 
  border: 1px solid #BBB; 
  width: 134px; 
  height: 20px;
  padding: 1px; 
  font: 100% arial, sans-serif;}

.form_settings 
{ margin: 15px 0 0 0;
}

.form_settings p
{ padding: 0 0 4px 0;}

.form_settings span
{ float: left; 
  width: 200px; 
  text-align: left;
   font: 170% arial, sans-serif;
  color:black;
    }
  
.form_settings input, .form_settings textarea
{ padding: 5px; 
  width: 299px; 
  font: 100% arial; 
  border: 1px solid #E5E5DB; 
  background: #FFF; 
  color: #47433F;}
  
.form_settings .submit
{ font: 100% arial; 
  border: 0; 
  width: 99px; 
  margin-left:115px;
  height: 33px;
  padding: 2px 0 3px 0;
  cursor: pointer; 
  background: #E7746F; 
  color: #FFF;}

.form_settings textarea, .form_settings select
{ font: 100% arial; 
  width: 299px;}

.form_settings select
{ width: 310px;}

.form_settings .checkbox
{ margin: 4px 0; 
  padding: 0; 
  width: 14px;
  border: 0;
  background: none;}

.separator
{ width: 100%;
  height: 0;
  border-top: 1px solid #D9D5CF;
  border-bottom: 1px solid #FFF;
  margin: 0 0 20px 0;}
  
table
{ margin: 10px 0 30px 0;}

table tr th, table tr td
{ background: #E7746F;
  color: #FFF;
  padding: 7px 4px;
  text-align: left;}
  
table tr td
{ background: #E5E5DB;
  color: #47433F;
  border-top: 1px solid #FFF;}
  
  #searchbtn
  {
   background: #E7746F; 
    border: none;
    color: white;
    border-radius: 12px;
    text-align: center;
    padding: 5px;
    text-decoration: none;
    display: inline-block;
    
  }
/* Style the form element with a border around it */
#newsletter{
    border: 4px solid #f1f1f1;
}
.panel{
    border: 2px solid #f1f1f1;
    margin-top: 30px; 
    width: 150px;
    border-radius: 5px;
}

.panel-body
{
height: 300px;
width: 150px;
color: black;
}

.panel-body h3
{
color: black;
font-size: 16px;
}
.panel-heading
{
width: 150px;
height: 30px;
background: #f1f1f1;
color: white; 
text-align: center;
border-radius: 5px;
}

#all
{
margin-top: -350px;
margin-bottom: 10px;
margin-left: 160px;
position: relative;

}

#all2
{
margin-bottom: 10px;
margin-left: 160px;
position: relative;

}
/* Add some padding and a grey background color to containers */
.container {
    padding: 20px;
    background-color: #f1f1f1;
}
.container h2{
    color: #E7746F;
}


/* Style the input elements and the submit button */
 #newsname, #newsemail,#newssub {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Add margins to the checkbox */
input[type=checkbox] {
    margin-top: 16px;
}

/* Style the submit button */
#newssub {
    background-color: #E7746F;
    color: white;
    border: none;
}

input[type=submit]:hover {
    opacity: 0.8;
}
</style>