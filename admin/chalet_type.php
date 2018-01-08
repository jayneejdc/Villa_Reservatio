<?php include 'sidebar.php';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms";
$rre= mysqli_query($mysqli, $query);
$options="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name=$_POST['name'];
    $price=$_POST['price'];
    $desc=$_POST['desc'];
    $avatar_path = $mysqli->real_escape_string('Images/'.$_FILES['avatar']['name']);
    if (preg_match("!image!",$_FILES['avatar']['type'])) {
        if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
            $sql="INSERT INTO  rooms (name, price, description, avatar, total) VALUES ('$name', '$price', '$desc', '$avatar_path', 5);";
            if ($mysqli->query($sql)){
                echo "YES!";
            }else{
                echo "NO SHIT!";
            }
        }
    }
    $result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($result)) {
        $options=$row[0];
    }
    for ($i=1; $i < 6 ; $i++) { 
        $num=($options*100)+$i;
        $sql="INSERT INTO  chalet (num, firstname, lastname, checkin, contact, status) VALUES ('$num', '', '', '', '', 1);";
        if ($mysqli->query($sql)){
            echo "YES!";
        }else{
            echo "NO!";
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    
    <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Chalet Number</small>
                        </h1>
                    </div>
                </div>
                 
                                 
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ADD NEW ROOM TYPE
                        </div>
                        <div class="panel-body">
                        <form name="form" method="post">
                            <div class="form-group">
                                <div>
                                    <form action="add_room_type.php" method="post" enctype="multipart/form-data" autocomplete="off">
            Name:<br> <input type="text" id="name" name="name" required >
            </br>
            Price:<br> <input type="text" id="price" name="price"  required>
            </br><br>
            Description:<br> <input type="text" id="desc" name="desc"  required>
            </br><br>
            <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="Images/*" required /></div><br><br>
            <button name="add-ch" value=1>Add Chalet</button>
        </form>
                                </div>             
                            </div>
                        </form>
                            
                        </div>
                        
                    </div>
                </div>

        <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Delete Chalet Type
                        </div>
                        <div class="panel-body">
                            <form name="form" method="post">
                                <div class="form-group">
                                    <label>Select the Room Type *</label>
                                    <select name="id"  class="form-control" required>
                                        <option value selected ></option>
                                        <?php
                                            while($rrow=mysqli_fetch_array($rre)){
                                                $name = $rrow['name'];
                                                $value = $rrow['id'];
                                                echo '<option name ="id" value="'.$value.'">'.$name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <input type="submit" name="del" value="Delete Room" class="btn btn-primary"> 
                            </form>
                            <?php                            
                                if(isset($_POST['del'])){
                                    $did = $_POST['id'];
                                    $sql ="DELETE FROM `rooms` WHERE id = '$did'" ;
                                    if(mysqli_query($mysqli,$sql)){}
                                }
                            ?>
                        </div>
                    </div>
                            
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Update Chalet Number
                        </div>
                        <div class="panel-body">
                    <div class="panel panel-default">
                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
