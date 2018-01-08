<?php
session_start();
$_SESSION['message'] = '';
$mysqli = new mysqli("localhost", "root", "", "hotel_reservation");

//the form has basename(path)een submitted with post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //two passwords are equal to each other
    if ($_POST['password'] == $_POST['confirmpassword']) {
        
        //set all the post variables
        $username = $mysqli->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = md5($_POST['password']); //md5 has password for security
        $avatar_path = $mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);
        
        //make sure the file type is image
        if (preg_match("!image!",$_FILES['avatar']['type'])) {
            
            //copy image to images/ folder 
            if (!preg_match('/[^A-Za-z0-9]+/', $password) || strlen($password) > 6 && strlen($password) < 8) {
        $_SESSION['message'] = 'Password should have (A-Z, a-z, 0-9 and length of 6-8 characters)';
        header("location: error.php");
      }
            elseif (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                
                //set session variables
                $_SESSION['username'] = $username;
                $_SESSION['avatar'] = $avatar_path;

                //insert user data into database
                $sql = "INSERT INTO users (first_name, last_name, email, password, avatar) "
                        . "VALUES ('$username', '$username', '$email', '$password', '$avatar_path')";
                
                //if the query is successsful, redirect to welcome.php page, done!
                if ($mysqli->query($sql) === true){
                    $_SESSION['message'] = "Registration succesful! Added $username to the database!";
                    header("location: welcome.php");
                }
                else {
                    $_SESSION['message'] = 'User could not be added to the database!';
                }
                $mysqli->close();          
            }
            else {
                $_SESSION['message'] = 'File upload failed!';
            }
        }
        else {
            $_SESSION['message'] = 'Please only upload GIF, JPG or PNG images!';
        }
    }
    else {
        $_SESSION['message'] = 'Two passwords do not match!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="add/bootstrap.min.css" type="text/css" rel="stylesheet">
  <script src="add/jquery.min.js"></script>
  <script src="add/bootstrap.min.js"></script>
  <style>
  .modal-header, h4, .close {
      background-color: black;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
      margin-top: -21.2%;
  }
  label{
    margin-right: 52%;
  }
  </style>
</head>

<div class="container">

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-default btn-lg" id="myBtn">Sign Up</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width:70%;">
        <div class="modal-header" style="padding:20px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="font-size: 80%;" ><img src="add/user.png" style="width: 15%; margin-top: -3%;"> Create an account</h4>
        </div>
        <div class="modal-body" style="padding:40px 30px;">
            <br>
         
            <form class="form" action="add/modal_signup.php" method="post" enctype="multipart/form-data" autocomplete="off" style="margin-top: -15%;">
                <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
                <label for="usrname">First Name</label>
                    <br><center><input type="text" placeholder="First Name" name="email" required /></center><br>
                    <label for="usrname">Last Name</label>
                    <br><center><input type="text" placeholder="Last Name" name="email" required /></center><br>
                    <label for="usrname">Username</label>
                    <br><center><input type="text" placeholder="User Name" name="username" required /></center><br>
                    <label for="usrname" style="margin-right: 58.2%;">Email</label>
                    <br><center><input type="email" placeholder="Email" name="email" required /></center><br>
                    <label for="usrname" style="margin-right: 53.5%;">Password</label>
                    <br><center><input type="password" placeholder="Password(6-8)" name="password" autocomplete="new-password" required /></center><br>
                    <label for="usrname">Confirm Password</label>
                    <br><center><input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required /></center><br>
                    <label style="margin-right: 40%;">Select your Avatar</label>
                    <br><center><div class="avatar"><input type="file" name="avatar" accept="image/*" required /></div></center><br>
                    <br><center><input type="submit" value="Register" name="register" class="btn btn-block btn-primary" style="width: 40%;" /></center>
                    <br><br>
          </form>
        </div>
        </div>

      </div>
    </div>
      </div>
    </div>
  </div> 
</div>
 
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>

</body>
</html>
