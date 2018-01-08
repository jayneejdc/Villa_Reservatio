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