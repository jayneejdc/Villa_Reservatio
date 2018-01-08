<?php include 'sidebar.php';?>
<?php include 'css.html';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms ORDER BY rid ASC";
$options="";
$result = mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_array($result)) {
    $options = $options."<option>$row[1]</option>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrator</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <script src="assets/js/custom-scripts.js"></script>
</head>
<body>
    <script>
        function myFunction() {
            alert("Chalet Number has been updated successfuly.");
        }
    </script>
	<div id="page-wrapper" style="margin-top: -5%;">
	    <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Status <small>Chalet Number</small>
                    </h1>
                </div>
            </div>                         
            <div class="row">
                <div class="col-md-4 col-sm-4" style="margin-left: -2%;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            UPDATE CHALET NUMBER
                        </div>
				        <div class="panel-body">
							<form action="update.php" method="POST">
							    <div class="form-group">
							        <label>Chalet Number: </label> 
							        <select name="num" class="form-control" required>
							            <option>
							                <?php
							                    $query = "SELECT * FROM chalet ORDER BY num ASC";
							                    $rre= mysqli_query($mysqli, $query);
							                    while($rrow=mysqli_fetch_array($rre)){
							                        $name = $rrow[0];
							                        $value = $rrow['id'];
							                        echo '<option name ="id" value="'.$name.'">'.$name.'</option>';
							                    }
							                ?>
							            </option>
							        </select><br>
							        <label>Chalet Type: </label> 
							        <select name="type" class="form-control" required>
							            <option>
							                <?php
							                    $query = "SELECT * FROM rooms";
							                    $rre= mysqli_query($mysqli, $query);
							                    while($rrow=mysqli_fetch_array($rre)){
							                        $name = $rrow['name'];
							                        $value = $rrow['rid'];
							                        echo '<option name ="id" value="'.$name.'">'.$name.'</option>';
							                    }
							                ?>
							            </option>
							        </select><br>
							        <a href="update.php"><br><input type="submit" name="a_new" class= "btn btn-primary" value="UPDATE" onclick="myFunction()"></a>
							    </div>
							</form>
						</div>
					</div>
				</div>	
				<div class="row">
                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                ROOMS INFORMATION
                            </div>
                            <div class="panel-body">
                                <div class="panel panel-default">
                                   <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Room Number</th>
                                                        <th>Chalet ID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>        
                                                    <?php
                                                        $sql = "SELECT * FROM chalet";
                                                        $re = mysqli_query($mysqli,$sql);
                                                        while($row= mysqli_fetch_array($re)){
                                                                $id = $row['id'];
                                                            if($id % 2 == 0){
                                                                echo "<tr class=odd gradeX>
                                                                    <td>".$row['num']."</td>
                                                                    <td>".$row['id']."</td>
                                                                </tr>";
                                                            }else{
                                                                echo"<tr class=even gradeC>
                                                                    <td>".$row['num']."</td>
                                                                    <td>".$row['id']."</td>
                                                                </tr>";
                                                            }
                                                        }
                                                    ?>
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
</body>
</html>