<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
 <script type="text/javascript">
 $(document).ready(function () {
		$("#tableMenu a").click(function(e){
	    e.preventDefault(); // cancel the link behaviour
	    var selText =  $(this).text();
	    $.ajax({
	    	type: "POST",
	    	url: "set_session_type.php",
	    	data: 'type=' + selText,
	    	cache: false,
	    	success:  function(result){
	    		window.location.href = "clothing.php";
	    	}
	    	});
	    
	});
		});
</script>
 <script type="text/javascript">
    function sort(order) {
       if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("all").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","sort.php?order="+order,true);
        xmlhttp.send();
    }
</script>

<script type="text/javascript">
    function disable_item(name){   
        document.getElementById(name).disabled = true;
    }
      
</script>

 <script type="text/javascript">
    function check(color) {
       if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("all").innerHTML = xmlhttp.responseText;
            }
        };
 	var x = "check.php?color="+color;
        xmlhttp.open("GET",x,true);
        xmlhttp.send();
    }
</script>




