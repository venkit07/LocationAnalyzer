<?php

$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"stayzilla") or die('Cant connect to local db');
$myfile = fopen("location.csv","r+") or die("Unable to open file!");
//$newfile = fopen("location_new.txt","w") or die("Unable to open file!");

$null_count=0;
$contains_count=0;
$perfect_count=0;
$wrong_count=0;
$total_count=0;
//echo fread($myfile, filesize("test.txt"));
$id=0;
while(!feof($myfile)){
		$array=(fgetcsv($myfile));

		//$location = "HSR";
		/*$qry = "SELECT max(row_id) from places";
		$result = mysqli_query($qry);
		$id = mysql_result($result, 0);*/
		//$id = 0;
		//mysql_query("INSERT INTO `places`(`row_id`,`latitude`,`longitude`) VALUES ( '".$id."','".$lat."','".$lat."')");";
		$lat=$array[0];
		$long=$array[1];
		$qry = "INSERT INTO places(row_id,latitude,longitude) VALUES ('".$id."','".$lat."','".$long."')";
		mysqli_query($con,$qry);
		$location=location_get($array[0],$array[1], $id);
		location_compare($location,$array[2], $id,$con);
		location_rating($lat,$long,$id,$con);
		
		echo "<br/>".++$id." ".$location."<br/>";
		if($id>3){
			break;
		}
}
echo "Null count = ".$null_count."<br/>Content_count = ".$contains_count."<br/>Perfect count = ".$perfect_count."<br/>Wrong count= ".$wrong_count."<br/>Total count= ".$total_count;
fclose($myfile);

 
function location_get($lat,$long,$row){
	$api_url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyCB3BimnzKbpsdGP7JSv-CqYC9NntcERg8';

	$curl = curl_init();
	curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $api_url, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0));

	$result = json_decode(curl_exec($curl),true);	
	$result=$result['results'][0]['address_components'];

	$final_location;
	foreach($result as $row)
	{
		
		$sub=$row['types'];
		//echo $sub[0]." ";
		if(in_array("sublocality_level_1", $sub)){
			$final_location = $row['long_name'];
			break;
		}else if(in_array("locality", $sub)){
			//echo $row['long_name']." ";
			$final_location = $row['long_name'];
			//echo "False"."<br/>";
			break;
		}else if(in_array("administrative_area_level_2", $sub)){
			//echo $row['long_name']." ";
			$final_location = $row['long_name'];
			//echo "False"."<br/>";
			break;
		}else if(in_array("administrative_area_level_1", $sub)){
			//echo $row['long_name']." ";
			$final_location = $row['long_name'];
			//echo "False"."<br/>";
			break;
		}
	
	}

	return $final_location;
	curl_close($curl);
}


function location_compare($location, $array_location,$row_id,$con){
	global $null_count,$perfect_count,$total_count,$wrong_count,$contains_count;
	$write_result;
	if(!$array_location || $array_location===""){
		$write_result = "NULL";
		$null_count++;
	}else if(strpos($array_location, $location)){
		$write_result = "CONTAINS";
		$contains_count++;
	}else if(!strcasecmp($array_location, $location)){
		$write_result = "PERFECT";
		$perfect_count++;
	}else{
		$write_result = "WRONG";
		$wrong_count++;
	}
	$total_count++;
/*	$qry = 'UPDATE places SET location='.$location.',location_real='.$array_location.' WHERE row_id='.$row_id;
if ($con->query($qry) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $con->error;
}*/

mysqli_query($con,"UPDATE places Set location = '$location',location_real = '$array_location', compare = '$write_result' Where row_id = '$row_id'");
	//mysqli_query($con,$qry);
	//fwrite($newfile,$array_location.",".$write_result.",".$location."\n");
}

function location_rating($lat,$long,$row_id,$con){
	$google_rating = getLocationRating($lat,$long);
	$stay_rating = stayzillaRating($lat,$long);

	mysqli_query($con,"UPDATE places Set rating = '$google_rating', stay_rating= '$stay_rating' Where row_id = '$row_id'");

}


function stayzillaRating($lat, $lng){
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
$cnt = count($result['hotels']);
if($cnt>25){
	$rating = 5;
}else{
	$rating = $cnt / 5;
}
curl_close($ch);
return $rating;
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
	$api_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$long."&radius=".$rad."&".$type."=".$types_name."&key=AIzaSyCB3BimnzKbpsdGP7JSv-CqYC9NntcERg8";
	//echo $api_url."<br/>";
	$curl = curl_init();
	curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $api_url, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0));

	$result = json_decode(curl_exec($curl),true);
	//$result = "";
	//print_r($result['results']);
	$num = count($result['results']);
	echo $types_name." : ".$num."<br/>";
	$score = 0;
	if($types_name === "shopping_mall"){
		$score = min($num*5, 100);
	}else if($types_name === "restaurant"){
		$score = min($num*10, 200);
	}else if($types_name === "bus"){
		$score = min($num*10, 200);
	}else if($types_name === "restaurant"){
		$score = min($num*10, 200);
	}
	return $score;
}
?>