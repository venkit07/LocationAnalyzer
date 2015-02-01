
<!doctype html>
  <?php
  $mscore=0;$rscore=0;$bscore=0;
  if(isset($_GET['lat']) && isset($_GET['long']))
  {
      $lat=$_GET['lat'];
  $long=$_GET['long'];
  if(isset($_GET['address']))
  $address=$_GET['address'];
    
    if($_GET['lat']==="" || $_GET['long']==="")
  {
    echo "<script>alert(\"Latitude and Longitude are required values !!\");window.location.href=\"stay.php\";</script>"; 
  }
 
  $loc=location_get($lat,$long);
  $text_result=location_compare($loc,$address);
  $rating=getLocationRating($lat,$long);
  //echo "ratings=".$rating;
  $url = "http://180.92.168.7/hotels";
$stay_score=abc($lat,$long);
if($stay_score>25)
{
  $stay_score=5;
}
else
{
  $stay_score=$stay_score/5;
}
//echo "stay_score=".$stay_score;

  
  ?>
  <html>
<head>

<title>StayHack</title>
<link rel="stylesheet" href="css/foundation.css"/>
<style type="text/css">
table, td, th {
    border: 1px solid green;
}

th,.blue {
    background-color:black;
    color: white;
}
td,.white {
    background-color: green;
    color: white;
}
span.stars, span.stars span {
    display: block;
    background: url(stars.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
}

span.stars span {
    background-position: 0 0;
}
body { background-color:white; }

.rowblack { background-color: #303030; }
.rowWhite { background-color: #303030; }
</style>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/modernizr.js"></script>
</head>
<body>
 
<div class="row rowblack" >
<div class="large-3 columns">
<h1>
  <div style="font-size:160%; color:white">StayHack<div/>
</h1>
</div>
<div class="large-9 columns">
<ul class="button-group right">
<li><a href="#" class="button">Location search</a></li>
<li><a href="gr.php" class="button">Analysis</a></li>


</ul>
</div>
</div>
 
 
<div class="row " >
<div class="large-12 columns rowWhite">
<form  action="#">
        <fieldset>
          <legend>Enter details</legend>

          
           <?php
            echo "<input type=\"text\" name=\"lat\" value=";if(isset($_GET["lat"]))echo "\"".$lat."\"";else echo "\"\"";echo "placeholder=Latitude>";
            echo "<input type=\"text\" name=\"long\" value=";if(isset($_GET["long"]))echo "\"".$long."\"";else echo "\"\""; echo "placeholder=Longitude>";
             echo "<input type=\"text\" name=\"address\" value=";if(isset($_GET["address"]))echo "\"".$address."\"";else echo "\"\""; echo "placeholder=Address>";
            ?>
            <button type="submit" class="button success">Submit</button>
         </div>
        </fieldset>

      </form>


</div>
 <br/><br/>
<div class="row" >
<div class="large-6 large-offset-3 columns">
  <h5>LOCATION COMPARISON RESULT :<b> <?php echo $text_result; ?></b></h5>
<h5>FACILITIES NEAR <b><?php echo $loc; ?></b></h5>
</div>
</div>
<div class="row">
<div class="large-4 large-offset-4 columns">

  <table>
     <th class="blue">FACILITY</th>
    <th class="blue">NUMBER</th>
<tr>
    <td class="white">RESTAURANTS</td>
    <td class="white"><?php echo $rscore; ?></td> 
  </tr>

<tr>
    <td class="white">SHOPPING MALLS</td>
    <td class="white"><?php echo $mscore; ?></td> 
  </tr>

<tr>
    <td class="white">BUS STOPS</td>
    <td class="white"><?php echo $bscore; ?></td> 
  </tr>
  </table>

</div>

</div>

 
<div class="row" style="color:green">
<div class="large-5 columns"style="border: 2px solid;
    border-radius: 25px;">

 <h2 style="color:blue">LOCATION SCORE<h2>
<h1 style="color:green"><b><?php echo $rating;?></b><h1><br/>
</div>
<!--h4>This is a content section.</h4>
<p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
<p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
-->

<div class="large-5 columns" style="border: 2px solid;
    border-radius: 25px;">
<h2 style="color:blue">STAYZILLA SCORE<h2>
    <h1 style="color:green"><b><?php echo $stay_score; ?></b><h1>
  <h1><span class="stars"><?php echo $stay_score; ?></span><h1><br/>
</div>
</div>
 
<footer class="row">
<div class="large-12 columns">
<hr/>
<div class="row">
<div class="large-6 columns">

</div>

</div>
</footer>

  <?php
}
else
{
  ?>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
 <html>
<head>

<title>StayHack</title>
<link rel="stylesheet" href="css/foundation.css"/>
<style type="text/css">
table, td, th {
    border: 1px solid green;
}

th,.blue {
    background-color:black;
    color: white;
}
td,.white {
    background-color: green;
    color: white;
}
span.stars, span.stars span {
    display: block;
    background: url(stars.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
}

span.stars span {
    background-position: 0 0;
}
body { background-color:white; }

.rowblack { background-color: #303030; }
.rowWhite { background-color: #303030; }
</style>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/modernizr.js"></script>
</head>
<body>
 
<div class="row rowblack" >
<div class="large-3 columns">
<h2>
 <div style="font-size:160%; color:white">StayHack<div/>
</h2>
</div>
<div class="large-9 columns">
<ul class="button-group right">
<li><a href="#" class="button">Location search</a></li>
<li><a href="gr.php" class="button">Analysis</a></li>


</ul>
</div>
</div>
 
 
<div class="row " >
<div class="large-12 columns rowWhite">
<form  action="#">
        <fieldset>
          <legend>Enter details</legend>

          
           <?php
            echo "<input type=\"text\" name=\"lat\" value=";if(isset($_GET["lat"]))echo "\"".$lat."\"";else echo "\"\"";echo "placeholder=Latitude>";
            echo "<input type=\"text\" name=\"long\" value=";if(isset($_GET["long"]))echo "\"".$long."\"";else echo "\"\""; echo "placeholder=Longitude>";
             echo "<input type=\"text\" name=\"address\" value=";if(isset($_GET["address"]))echo "\"".$address."\"";else echo "\"\""; echo "placeholder=Address>";
            ?>
            <button type="submit" class="button success">Submit</button>
         </div>
        </fieldset>

      </form>


</div>
 <?php
}
?>
<script>
  document.write('<script src=js/vendor/' +
  ('__proto__' in {} ? 'zepto' : 'jquery') +
  '.js><\/script>')
  </script>
<script src="../../assets/js/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
  </script>
<script src="../assets/js/templates/jquery.js"></script>
<script src="../assets/js/templates/foundation.js"></script>
<script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>

</body>
<script>
  $.fn.stars = function() {
    return $(this).each(function() {
        // Get the value
        var val = parseFloat($(this).html());
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = Math.max(0, (Math.min(5, val))) * 16;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}
$(function() {
    $('span.stars').stars();
});
</script>
<?php
function location_get($lat,$long){
  //echo $lat." ".$long;                           
  //$lat=12.913811;
  //$long=77.637504;
  $api_url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyBE6q5Mpy--3y4GNWeBaCSMzFhNsJmuUfU';

  $curl = curl_init();
  curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $api_url, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0));

  $result = json_decode(curl_exec($curl),true); 

  $result=$result['results'][0]['address_components'];

  $final_location;
  foreach($result as $row)
  {
    
    $sub=$row['types'];
  
    if(in_array("sublocality_level_1", $sub)){
      $final_location = $row['long_name'];
      break;
    }else if(in_array("locality", $sub)){
  
      $final_location = $row['long_name'];
  
      break;
    }else if(in_array("administrative_area_level_2", $sub)){
  
      $final_location = $row['long_name'];
  
      break;
    }else if(in_array("administrative_area_level_1", $sub)){
  
      $final_location = $row['long_name'];
  
      break;
    }
      /*if($sub[0]==="sublocality_level_1")
      {
        echo $row['long_name'];
        //return $row['long_name'];
      }
    echo "<br/>";*/
  }

  return $final_location;

}
function location_compare($location, $array_location){
 
 
  $write_result;
  if(!$array_location || $array_location===""){
    $write_result = "NULL";

  }else if(strpos($array_location, $location)){
    $write_result = "CONTAINS";

  }else if(!strcasecmp($array_location, $location)){
    $write_result = "PERFECT";

  }else{
    $write_result = "WRONG";

  }

return $write_result;
}



function getLocationRating($lat, $long){
  $rating=0;
  $rating = $rating + doRating($lat, $long, "500", "types", "shopping_mall");
  $rating = $rating + doRating($lat, $long, "500", "types","restaurant");
  $rating = $rating + doRating($lat, $long, "500", "name","bus");
  //doRating($lat, $long, "500", "shopping_mall");
  return $rating;
  
}


function doRating($lat, $long, $rad, $type, $types_name){
  global $mscore,$bscore,$rscore;
  $api_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$long."&radius=".$rad."&".$type."=".$types_name."&key=AIzaSyBE6q5Mpy--3y4GNWeBaCSMzFhNsJmuUfU";
  //echo $api_url."<br/>";
  $curl = curl_init();
  curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $api_url, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0));

  $result = json_decode(curl_exec($curl),true);
  //$result = "";
  //print_r($result['results']);
  $num = count($result['results']);

  $score = 0;
  if($types_name === "shopping_mall"){
    $score = min($num*5, 100);
    $mscore=$num;
  }else if($types_name === "restaurant"){
    $score = min($num*10, 200);
    $rscore=$num;
  }else if($types_name === "bus"){
    $score = min($num*10, 200);
    $bscore=$num;
  }else if($types_name === "restaurant"){
    $score = min($num*10, 200);
    $rscore=$num;
  }
  return $score;
}

function abc($lat, $lng){
$url = "http://180.92.168.7/hotels";
$fields = array(
            'lat'=>urlencode($lat),
            'lng'=>urlencode($lng),
            "checkin" => urlencode("06/05/2015"),
        "checkout" => urlencode("11/05/2015"),
        "property_type" => urlencode("Hotels")
        );

//url-ify the data for the POST
$fields_string="";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

 $result = json_decode(curl_exec($ch),true);
return count($result['hotels']);

}
?>
</html>