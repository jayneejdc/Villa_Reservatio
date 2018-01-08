<?php include 'header.php';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$time=date("m/d/Y");
$query = "SELECT * FROM reservation";
$result = mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_array($result)) {
	$line=$row[0];
	$checkin=$row[3];
	$lastname=$row[2];
	$firstname=$row[1];
	$contact=$row[6];
	$picked=$row[7];
	$query = "SELECT * FROM rooms";
	$result = mysqli_query($mysqli, $query);
	while ($row = mysqli_fetch_array($result)) {
		if ($picked==$row[0]) {
			$temps=$row[0];
			$price=$row[2];
			$query = "SELECT * FROM chalet ORDER BY num ASC";
			$result = mysqli_query($mysqli, $query);
			while ($row = mysqli_fetch_array($result)) {
				$trow = $row[0];
				if ($trow[0]==$temps[0] || strlen($trow)==strlen($temps)) {
					if (empty($row[1])) {
						$temp=$row[0];
						$time=date("m/d/Y");
						if ($checkin==$time){
							$sql ="CALL aupd('".$temp."', '".$lastname."', '".$firstname."', '".$checkin."', '".$contact."')";
							if ( $mysqli->query($sql) ){
								if ( $mysqli->query($sql) ){
									$sql ="CALL adel('".$line."')";
									if ( $mysqli->query($sql) ){
										break;
									}
								}
							}
						}
					}
				}	
			}
		}
	}		
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Villa Reservatio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
	<div id="container">
		<div class="slides">
			<p>Welcome to Villa Reservatio</p>
			<img src="Images/beach4.jpg" style="width: 100%;  height: 680px;  margin-left: -1%; margin-top: -5%;" />
			<a class="btn" href="chalet.php" style="font-family:'Bad Script', cursive; src: url('font-awesome/BadScript-Regular.ttf');">BOOK NOW</a>
		</div>
		<div  class="slides">
			<img src="Images/beach8.jpg" style="width: 100%; height:680px;  margin-left: -1%; margin-top: -5%;"/>
			<a class="btn" href="chalet.php" style="font-family: 'Bad Script', cursive; src: url('font-awesome/BadScript-Regular.ttf');">BOOK NOW</a>
		</div>
		<div  class="slides">
			<p>Be happy in our Luxury Cottages</p>
			<img src="Images/beach3.jpg" style="width: 100%; height:680px;  margin-left: -1%; margin-top: -5%;"/>
			<a class="btn" href="chalet.php" style="font-family: 'Bad Script', cursive; src: url('font-awesome/BadScript-Regular.ttf');">BOOK NOW</a>
		</div>
		<div  class="slides">
			<img src="Images/beach7.jpg" style="width: 100%; height:680px;  margin-left: -1%; margin-top: -5%;"/>
			<a class="btn" href="chalet.php" style="font-family: 'Bad Script', cursive; src: url('font-awesome/BadScript-Regular.ttf');">BOOK NOW</a>
		</div>
		<div  class="slides">
			<p>Enjoy staying in our Comfortable Cottages</p>
			<img src="Images/beach.jpg" style="width: 100%; height:680px;  margin-left: -1%; margin-top: -5%;"/>
			<a class="btn" href="chalet.php" style="font-family: 'Bad Script', cursive; src: url('font-awesome/BadScript-Regular.ttf');">BOOK NOW</a>
		</div>
	</div>
		<script>
			var index = 1;
			function plusIndex(n){
				index = index + n;
				showImage(index);
			}
			showImage(1);
			function showImage(n){
				var i;
				var x = document.getElementsByClassName("slides")
				if( n > x.length ){ index = 1};
				if( n < 1) { index = x.length};
				for(i=0;i<x.length;i++ ){
					x[i].style.display = "none";
				}
				x[index-1].style.display = "block";
			}
			autoSlide();
			function autoSlide(){
				var i;
				var x = document.getElementsByClassName("slides")
				for(i=0;i<x.length;i++ ){
					x[i].style.display = "none";
				}
				if(index > x.length){
					index = 1
				}
				x[index-1].style.display = "block";
				index++;
				setTimeout(autoSlide, 3000);
			}
		</script>
	</div>
	<img src="Images/gold.png"; id="pic1" style="width: 70%; height: 200px; margin-left: 13%;">

	<div id="ammenities" class="fluid-container col-lg-12">
		<div>
			<br>
			<h1>	
				Ammenities
			</h1>
			<p>All of these ammenities are included in every booking made for each guests.</p>
		</div>

		<div class="allam">
			<div class="ab col-4" style="margin-top: 5%; margin-left: 28%;">
				<img src="Images/ammenities/shuttle.png" class="ab-pic">
				<h5>Shuttle Service</h5>
			</div>
			<div class="ab col-4" style="margin-top: -11.5%; margin-left: 45%;" >
				<img src="Images/ammenities/wifi.png" class="ab-pic" style="width: 13%">
				<h5>Free Wifi</h5>
			</div>
		</div>		
	</div>

	<img src="Images/gold.png"; id="pic2" style="width: 70%; height: 250px; margin-left: 13%;">

	<div id="about" class="fluid-container col-lg-12">
			<h1>
				About Us
			</h1>
			<p>
				This is located in Tigatto, Davao City, Philippines, Villa Reservatio Beach Resort is committed to provide the highest quality of service to ensure the best holiday experience. It’s no wonder that we have been awarded TripAdvisor’s Certificate of Excellence for three years in a row, for having been consistently rated 4 or 5 stars by our guests.
				Quality time with the family. Activities that pump your adrenalin. Luxurious pampering during your me-time. At our beach resort in Cabantian and Puan, you can do what you wish, at your own pace and time. The topnotch facilities and services we have make it easy for you to tick off the items in your holiday checklist.
			</p>
			<br><br>
			<img src="Images/beach1.jpg">
	</div>
	<br>
	<img src="Images/gold.png"; id="pic3" style="width: 70%; height: 200px; margin-left: 13%;">

	<div id="contact" class="fluid-container col-lg-12">
			<br>
			<h1>Contact Us</h1>
			<p>
				<br>
				Tel no. +82 2-8511-8891<br>
				E-mail: pio@usep.edu.ph<br>
				Website: usep.edu.ph<br>
			</p>
			<div class="icons">
			<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<br>
	</div>
	<br><br><br>
	<img src="Images/gold.png"; style="width: 100%; height: 200px; margin-left: -1%;">
</body>
</html>