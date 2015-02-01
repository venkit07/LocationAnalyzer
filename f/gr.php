<!DOCTYPE html>
<?php
 if(isset($_GET['sz']))
          {
          $sz=1;
          }
          else
          {
            $sz=0;
          }
  ?>
<html>
  <head>
    
<title>StayHack</title>
<link rel="stylesheet" href="css/foundation.css"/>
    <link href="build/css/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="build/css/horizBarChart.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/modernizr.js"></script>
    <script src="build/js/jquery.min.js"></script>
    <script src="build/js/jquery.horizBarChart.js"></script>

    <script>
      $(document).ready(function(){
        $('.chart').horizBarChart({
          selector: '.bar',
          speed: 3000
        });
      });
    </script>

<div class="row rowblack" >
<div class="large-3 columns">
<h1>
  <div style="font-size:200%">StayHack<div/>
</h1>
</div>
<div class="large-9 columns">
<ul class="button-group right">
<li><a href="stay.php" class="button">Location search</a></li>
<li><a href="#" class="button">Analysis</a></li>


</ul>
</div>
</div>
  </head>
  <body>
    <div class="wrapper">
      <section>

<div class="row">
  <div class="large-8 columns">
        <h1>STAYZILLA vs LOCATION TREND</h1>
</div>
<div class="large-4 columns">
  <?php
  if(isset($_GET['sz']))
  {
    ?>
<li><a href="gr.php" class="button success">Sort by Loc Ratings</a></li>
<?php
}
else
{
?>
<li><a href="gr.php?sz=1" class="button success">Sort by SZ Ratings</a></li>
<?php } ?>
</div>

        <!-- Code Start -->
        <div class="chart-horiz clearfix">
          <!-- Actual bar chart -->
          <?php
         
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stayzilla";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_GET['sz']))
{
$sql = "SELECT location,stay_rating,rating from places GROUP BY location ORDER BY stay_rating DESC";
}
else
{
  $sql = "SELECT location,stay_rating,rating from places GROUP BY location ORDER BY rating DESC";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
  ?>

 <ul class="chart">
            <li class="title"></li>
  <?php
    while($row = $result->fetch_assoc()) {
   ?>
           <?php echo "<div style = \"font-size: 160%\">".$row["location"]."</div>"; ?>
            
            <li class="current" title=""><span class="bar" data-number=<?php echo $row["rating"]; ?>></span><span class="number"><?php echo $row["rating"]; ?></span></li>
            <li class="past" title=""><span class="bar" data-number=<?php echo round($row["stay_rating"]/6,2); ?> ?>></span><span class="number"><?php echo round($row["stay_rating"]/6,2);
            $r=$row["stay_rating"]/6;
            if($r<2)
            {
              echo "<div style=\"color:red\"> VERY LOW </div>";
            }
            if($r>=2 && $r<=3)
            {
               echo "<div style=\"color:red\"> LOW </div>";
            }
            if($r>3 && $r<=3.8)
            {
            echo "<div style=\"color:#A0A000\"> AVERAGE</div>";
            }
            if($r>3.8 && $r <=4.5)
            {
               echo "<div style=\"color:orange\"> GOOD </div>";
            }
            if($r>4.5)
            {
               echo "<div style=\"color:orange\"> GREAT! </div>";
            }
             ?></span></li>
         <br/>
   
                <?php
           }
           ?>
            </ul>
            <?php
        }
        else {
    echo "0 results";
}
$conn->close();

          ?>
         
       
        </div>
        <!-- Code End -->

      </section>



    </div>


    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-54600611-1', 'auto');
      ga('send', 'pageview');

    </script>
    <script>
      var trackOutboundLink = function(url) {
         ga('send', 'event', 'outbound', 'click', url, {'hitCallback':
           function () {
           document.location = url;
           }
         });
      }
    
    </script>
  </body>
</html>