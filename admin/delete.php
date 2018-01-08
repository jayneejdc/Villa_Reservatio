<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

$query = "SELECT * FROM rooms";
$result = mysqli_query($mysqli, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $picked=$_POST['picked'];
    while ($row = mysqli_fetch_array($result)) {
        if ($row[1]==$picked) {
            $temp=$row[0];
            $sql="CALL delroom('".$temp."')";
            if ($mysqli->query($sql)){
            }
            $query = "SELECT * FROM chalet";
            $result = mysqli_query($mysqli, $query);
            while ($row = mysqli_fetch_array($result)) {
                if ($row[6]==$temp) {
                    $sql="CALL delcha('".$temp."')";
                    if ($mysqli->query($sql)){
                        header("Location: delete_type.php");
                    }
                }
            }
        }
    }
}

?>