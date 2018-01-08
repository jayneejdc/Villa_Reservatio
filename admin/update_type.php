<?php include 'sidebar.php';?>
<?php include 'css.html';?>


<head>
    <title>Update Room Type</title>
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
            alert("Chalet Type has been updated successfuly.");
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
                            UPDATE CHALET TYPE
                        </div>
                        <div class="panel-body">
                            <form action="update_type.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                <label>Select the Room Type *</label>
                                <select name="lol"  class="form-control" onchange = "this.form.submit();">
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
                                </select>
                            </form>
                            <form action="updatenalang.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                <?php
                                if (isset($_POST['lol'])) {
                                    $temp=$_POST['lol'];
                                    $query = "SELECT * FROM rooms";
                                    $result= mysqli_query($mysqli, $query);
                                    while($row=mysqli_fetch_array($result)){
                                        if ($row[1]==$temp) {
                                ?>
                                    <label>Chalet Name: </label><br><input type="text" name="name" value="<?php echo $row['name'] ?>"><br><br>
                                    <label>Price: </label><br><input type="text" name="price" value="<?php echo $row['price'] ?>"><br><br>
                                    <label>Description: </label><br><input type="text" name="desc" value="<?php echo $row['description'] ?>"><br>   <br>
                                    <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="Images/*" required /></div><br>
                                        <input type="hidden" name="picked" value="<?php echo $row[0] ?>">
                                        <input type="submit" name="update" value="UPDATE" onclick="myFunction()">
                                    <br><br>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
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