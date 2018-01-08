<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM chalet";
$result = mysqli_query($mysqli, $query);

$options='';
while ($row = mysqli_fetch_array($result)) {
	$options = $options."<option>$row[0]</option>";
}

$query = "SELECT * FROM chalet";
$result = mysqli_query($mysqli, $query);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$picked=$_POST['picked'];
	while ($row = mysqli_fetch_array($result)) {
		if ($row[0]==$picked) {
			$temp=$row[0];
			$id=$row[6];
			$sql="CALL delchan('".$temp."')";
			if ($mysqli->query($sql)){
				header("Location: delete_num.php");
			}

			$query = "SELECT * FROM rooms";
			$result = mysqli_query($mysqli, $query);
			while ($row = mysqli_fetch_array($result)) {
				if ($id==$row[0]) {
					$temp=($row[5])-1;
					$sql="CALL uprooms('".$temp."', '".$id."')";
					if ($mysqli->query($sql)){
						header("Location: delete_num.php");
					}
				}
			}
		}
	}
}

?>