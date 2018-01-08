<?php include 'sidebar.php';?>
<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM rooms";
$options="";
$result = mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_array($result)) {
    $options = $options."<option>$row[1]</option>";
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
                            ADD NEW ROOM
                        </div>
                        <div class="panel-body">
                            <form name="form" method="post">  
                                <div class="form-group">
                                      <label>Chalet Type: </label> 
                                        <select name="picked" class="form-control" required onchange = "this.form.submit();">
                                            <option>
                                            </option>
                                            <?php echo $options; ?>
                                        </select>
                               </div>
                               <div class="form-group">
                                      <label>No. of Rooms Added: </label>
                                        <form action="deluxe.php" method="POST">
                                          <input type="number" name="add">
                                        </form>
                                   

                               </div>
                               <input type="submit" class= "btn btn-primary" value="Add New">
                            </form>
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
