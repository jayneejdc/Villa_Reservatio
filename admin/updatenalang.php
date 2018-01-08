<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

$name=$_POST['name'];
$price=$_POST['price'];
$desc=$_POST['desc'];
$picked=$_POST['picked'];
$avatar_path = $mysqli->real_escape_string('Images/'.$_FILES['avatar']['name']);

$query = "SELECT * FROM rooms";
$rre= mysqli_query($mysqli, $query);

if (preg_match("!image!",$_FILES['avatar']['type'])) {
    if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
        $sql= "CALL upro('".$name."', '".$price."', '".$desc."', '".$avatar_path."', '".$picked."');";
        if ($mysqli->query($sql)){
            header("Location: update_type.php");
        }else{
        	echo "BAHO SI MART";
        }
	}
}
?>