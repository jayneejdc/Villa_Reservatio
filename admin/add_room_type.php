<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms";
$result= mysqli_query($mysqli, $query);
$options="";
$lol="0";
$tot="5";
if(isset($_POST['add-ch'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name=$_POST['name'];
        $price=$_POST['price'];
        $desc=$_POST['desc'];
        $avatar_path = $mysqli->real_escape_string('Images/'.$_FILES['avatar']['name']);
        if (preg_match("!image!",$_FILES['avatar']['type'])) {
            if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                while ($row = mysqli_fetch_array($result)) {
                    if ($row[1]==$name) {
                        $lol=$lol+1;
                    }
                }
                if ($lol==0) {
                    $sql="CALL irooms('".$name."', '".$price."', '".$desc."', '".$avatar_path."', '".$tot."')";
                    if ($mysqli->query($sql)){
                        echo "YES!";
                    }
                }
            }
        }
        $result = mysqli_query($mysqli, $query);
        while ($row = mysqli_fetch_array($result)) {
            $options=$row[0];
        }
        for ($i=1; $i < 6 ; $i++) { 
            $num=($options*100)+$i;
            $sql="INSERT INTO  chalet (num, firstname, lastname, checkin, contact, status, id) VALUES ('$num', '', '', '', '', 1, '$options');";
            if ($mysqli->query($sql)){
                header("Location: add_type.php");
            }else{
                header("Location: add_type.php");
            }
        }
    }
}