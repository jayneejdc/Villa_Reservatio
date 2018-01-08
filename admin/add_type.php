<?php include 'sidebar.php';?>
<?php include 'css.html';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Room Type</title>
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
            alert("Chalet Type has been added successfuly.");
        }
    </script>
	<div id="page-wrapper" style="margin-top: -5%;">
	    <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Status <small>Chalet Type</small>
                    </h1>
                </div>
            </div>                         
            <div class="row">
                <div class="col-md-4 col-sm-4" style="margin-left: -2%;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ADD NEW ROOM TYPE
                        </div>
				        <div class="panel-body">
							<div id="add-rt-content">
								<div>
									<form action="add_room_type.php" method="post" enctype="multipart/form-data" autocomplete="off">
										Name:<br> <input type="text" id="name" name="name" required><br><br>
										Price:<br> <input type="text" id="price" name="price"  required><br>
										</br>
										Description:<br> <input type="text" id="desc" name="desc" style="width: 90%; height: 50px;" required>
										</br><br>
										<div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="Images/*" required /></div><br>
										<button class="btn btn-primary" name="add-ch" value=1 style="margin-left: 30%;" onclick="myFunction()">CREATE</button>
									</form>
								</div>
							</div>
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
                                                        <th>Room ID</th>
                                                        <th>Room Name</th>
                                                        <th>Price</th>
                                                        <th>Total Rooms</th>
                                                    </tr>
                                                </thead>
                                                <tbody>        
                                                    <?php
                				                        $sql = "SELECT * FROM rooms";
                				                        $re = mysqli_query($mysqli,$sql);
                                                        while($row= mysqli_fetch_array($re)){
                                                                $id = $row['rid'];
                                                            if($id % 2 == 0){
                                                                echo "<tr class=odd gradeX>
                                                                    <td>".$row['rid']."</td>
                                                                    <td>".$row['name']."</td>
                                                                   <th>".$row['price']."</th>
                                                                   <th>".$row['total']."</th>
                                                                </tr>";
                                                            }else{
                                                                echo"<tr class=even gradeC>
                                                                    <td>".$row['rid']."</td>
                                                                    <td>".$row['name']."</td>
                                                                   <th>".$row['price']."</th>
                                                                   <th>".$row['total']."</th>
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