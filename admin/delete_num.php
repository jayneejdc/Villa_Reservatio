<?php include 'sidebar.php';?>
<?php include 'css.html';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$sql ="SELECT * from chalet ORDER BY num ASC";
$rre=mysqli_query($mysqli,$sql);
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
            alert("Chalet Room Number has been Deleted successfuly.");
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
                            DELETE ROOM NUMBER 
                        </div>
					    <div class="panel-body">
                            <form action="delroom.php" method="post">
				                <div class="form-group">
				                    <label>Select the Room Type *</label>
				                    <select name="picked"  class="form-control" required>
										<option value selected ></option>
											<?php
												while($rrow=mysqli_fetch_array($rre)){
													$name = $rrow[0];
													echo '<option name ="id" value="'.$name.'">'.$name.'</option>';
												}
											?>
				                    </select>
				                </div>
								<input type="submit" name="del" value="Delete Room" class="btn btn-primary" onclick="myFunction()"> 
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
        </div>
    </div>
</body>
</html>