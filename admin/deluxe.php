<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms";
$result = mysqli_query($mysqli, $query);


$picked=$_POST['picked'];
$add=$_POST['add'];

while ($row = mysqli_fetch_array($result)) {
	$temp = $row[1];
	if ($temp==$picked) {
		$total=$row[5];
		$id=$row[0];
		for ($x=1; $x < ($add+1) ; $x++) { 
			$num=($id*100)+$total+$x;
			$sql="INSERT INTO  chalet (num, firstname, lastname, checkin, contact, status, id) VALUES ('$num', '', '', '', '', 1, '$id');";
			if ($mysqli->query($sql)){
	           	$sum=$total+$add;
	           	$sql="UPDATE rooms SET total = '$sum' WHERE rid = '$id' ";
	           	if ($mysqli->query($sql)){
	           		 header("Location: add_num.php");
	           	}else{
	           		echo "haysssss";
	           	}
	        }
		}
	}
}

?>