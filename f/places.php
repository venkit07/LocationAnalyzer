		<?php
	if(isset($_GET['lat']) && isset($_GET['long']) && isset($_GET['address']))

	{
		
		if($_GET['lat']==="" || $_GET['long']==="" || $_GET['address']==="")
	{
		echo "<script>alert(\"All values need to be entered !!\");window.location.href=\"places.php\";</script>"; 
	}
	$lat=$_GET['lat'];
	$long=$_GET['long'];
	$address=$_GET['address'];
	echo $lat."<br/>".$long."<br/>".$address."<br/>";
	
	}


		?>
			<html>
			
				 <link rel="stylesheet" href="css/foundation.css">

		  <!-- This is how you would link your custom stylesheet -->
		  <link rel="stylesheet" href="css/app.css">

		  <script src="js/vendor/modernizr.js"></script>

		</head>
			<body>




				<br/><br/><br/>
				<div class="row">
					<div class="small-8 small-offset-2 columns">

				<form  action="#">
			  <fieldset>
			    <legend>Enter details</legend>

			    
			      <input type="text" name="lat" placeholder="Latitude">
			      <input type="text" name="long" placeholder="Longitude">
			      <input type="text" name="address" placeholder="Address">
			      <button type="submit" class="button success">Default Button</button>
			   
			  </fieldset>
			</form>
			</div>
			</div>
			</body>
			</html>