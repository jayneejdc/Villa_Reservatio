<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms";
$options="";
$result = mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_array($result)) {
	$options = $options."<option>$row[1]</option>";
}
$temp="";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chalet</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/rooms.css">
	<script src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        var targetBox = $("." + inputValue);
		        $(".box").not(targetBox).hide();
		        $(targetBox).show();
		    });
		});
	</script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>
<body>
	<div class="cottage" style="padding: 1%;">
		<?php
			//$num = $_POST['picked'];
			if(isset($_POST['picked'])){
				$select_ch = "select * from rooms where name = '".$_POST['picked']."' ";
				$result = mysqli_query($mysqli,$select_ch);
				if($result){
					while($row = mysqli_fetch_assoc($result)){
						echo "<h1>".$row['name']."</h1><br> ";
						echo "<img width="."200"." height="."200"." src=admin/".$row['avatar'].">";
						echo "<h3>".$row['price']."</h3><br> ";
						echo "<p>".$row['description']."</p><br> ";
					}
				}else{
					echo "ERROR: Could not able to execute" ;
				}
			}
		?>
	</div>
	<br><br>
	<div class="sideform" style="margin-top: 1%;">
		<div style="padding: 2%; margin-top: -6%;">
			<div class="payment">
				<label style="margin-left: 5%; color: black;">
				    <div>
				    	<br><br>
				    	<h2><center>Reservation Information</center></h2>
				    	<div style="font-size: 16px;">
				    		<center>
					    		<form action="chalet.php" method="POST" style="margin-left: 30px;">
					    			<br>
									<label>Room Type:  
										<select name="picked" onchange = "this.form.submit();">
											<option>
												<!--<?php
											/**if($_SERVER["REQUEST_METHOD"] == "POST")){
								    			echo $_POST['picked'];
								    		}*/
											?>-->
											</option>
											<?php echo $options; ?>
										</select>
									</label>
								</form>
							</center>
				    	</div>
				    	<form action="insert/cottage1.php" method="POST">
					    	<div class="reservationInfo">
					    		<br><br>
					    		<?php
						    		if(isset($_POST['picked'])){
						    			$temp=$_POST['picked'];
						    			$query = "SELECT * FROM rooms";
										$options="";
										$result = mysqli_query($mysqli, $query);
										while ($row = mysqli_fetch_array($result)) {
											if ($row[1]==$temp) {
												$temp=$row[0];
											}
										}
						    		}
					    		?>
								<br>
								<input type="hidden" name="type" value="<?php echo $temp ?>">
								<label>Check-in:<br><input id="txtstartdate" name="checkin" min="2017-11-16" required></label><br>
							</div>
							<div class="personal">
								<label>First Name:<br><input type="text" name="firstname" style="width: 100%;" required></label><br>
								<label>Last Name:<br><input type="text" name="lastname" style="width: 100%;" required></label><br>
								<label>Contact #:<br><input type="text" name="contact" style="width: 100%;" required></label>
							</div>
							<br><input type="checkbox" name="terms" value="terms" required><label style="color: black;"> I have read and agreed to the </label> <a href="terms.pdf" download>Terms and Condition<br>
		    				<div class="btn">
								<a href="insert/cottage1.php"><input type="submit" name="submit" value="Reserve"></a>	
							</div>
						</form>
				    </div>
    			</label>
			</div>
		</div>
	</div>
</body>

<script>
	$("#txtstartdate").datepicker({
	  minDate: 0,
	  onSelect: function(date) {
	    $("#txtenddate").datepicker('option', 'minDate', date);
	  }
	});
	$("#txtenddate").datepicker({});
	$("#start").datepicker({
	  minDate: 0,
	  onSelect: function(date) {
	    $("#end").datepicker('option', 'minDate', date);
	  }
	});
	$("#end").datepicker({});
</script>
</html>