<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'villa_reservatio';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$sql ="select * from rooms";
$rre=mysqli_query($mysqli,$sql);

?>
							 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="page-wrapper" >
    <div id="page-inner">
		<div class="row">
			<div class="col-md-5 col-sm-5">
				<div class="panel panel-primary">
			        <div class="panel-heading">
			           Delete room
			        </div>
			        <div class="panel-body">
						<form name="form" method="post">
			                <div class="form-group">
			                    <label>Select the Room Type *</label>
			                    <select name="id"  class="form-control" required>
									<option value selected ></option>
										<?php
											while($rrow=mysqli_fetch_array($rre))
												{
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
							 if(isset($_POST['del']))
							 {
								$did = $_POST['id'];
								$sql ="DELETE FROM `rooms` WHERE id = '$did'" ;
								if(mysqli_query($mysqli,$sql)){}
							 }
							?>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
</div>
	<!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script> 
</body>
</html>
