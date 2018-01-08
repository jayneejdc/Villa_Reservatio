<?php include 'sidebar.php';?>
<?php include 'css.html';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms";
$result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Room Type</title>
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
            alert("Chalet Type has been Deleted successfuly.");
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
			<div class="row" style="margin-top: -50%;">
                <div class="col-md-4 col-sm-4" style="margin-left: -2%;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Delete Chalet Type
                        </div>
                        <div class="panel-body">
                            <form action="delete.php" method="post">
                                <div class="form-group">
                                    <label>Select the Room Type *</label>
                                    <select name="picked"  class="form-control" required>
                                        <option value selected ></option>
                                        <?php
                                            while($rrow=mysqli_fetch_array($result)){
                                                $name = $rrow['name'];
                                                echo '<option name ="picked" value="'.$name.'">'.$name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <input class="btn btn-primary" type="submit" name="del" value="DELETE" onclick="myFunction()">
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