<?php
  session_start();
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'villa_reservatio';
  $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
  // Escape email to protect against SQL injections
  $result = $mysqli->query("call login_p();");
  $email = $mysqli->escape_string($_POST['email']);
  $password = md5($_POST['password']);
  $firstname="";
  $lastname="";
  $temp="0";
  while ($row = mysqli_fetch_array($result)) {
    if ($row[1]==$email) {
            $firstname=$row[4];
            $lastname=$row[3];
            $num = $row[1];
            $temp="1";
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['num'] = $num;
            $num = $_SESSION['num'];
            $firstname = $_SESSION['firstname'];
            $lastname = $_SESSION['lastname'];
            header("location:home.php");
          }
        }
  

  if ($temp=="0") {
    $_SESSION['message'] = "Please put valid credentials";
    header("location: error.php");
  }
?>