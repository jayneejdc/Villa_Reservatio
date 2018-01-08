<?php include 'sidebar.php';?>
<?php include 'css.html';?>
<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$query = "SELECT * FROM chalet ORDER BY num";
$result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
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
    <title>Administrator</title>
</head>

<body>
   
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Archive Details </small>
                        </h1>
                    </div>
                </div>
      <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="">
                            <div class="panel-group">
                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                      Archive             
                                        </h4>
                                    </div>
                                        <div class="panel-body">
                                           <div class="panel panel-default">

 <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Chalet Number</th>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Check-in</th>
                                            <th>Amount</th>
                                            <th>Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                       $query = "SELECT * FROM history";
                                       $result = mysqli_query($mysqli, $query);
                                         while ($row = mysqli_fetch_array($result)) :
                                          if ($row[6]=="1") : ?>
                                       <tr>
                                          <form method="post" action="old.php">
                                        
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td><?php echo $row[3]?></td>
                                            <td><?php echo $row[4]?></td>
                                            <td><?php echo $row[5]?></td>
                                            <td><input type="submit" name="action" class="btn btn-info" value="Unarchive"/></td>
                                            <input type="hidden" name="picked" class="btn btn-infor" value="<?php echo $row['history_id']; ?>"/>
                                                  </form>
                                              </tr>
                                            <?php endif; ?>
                                            <?php endwhile; ?>
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
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <script src="assets/js/custom-scripts.js"></script>
    

</body>

</html>