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
    <title>Administrator</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php"> ADMIN</a>
            </div>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="home.php"><i class="fa fa-book"></i> Booking</a>
                    </li>
                    <li>
                        <a href="reservation.php"><i class="fa fa-book"></i> Reservation</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#menu-1"><i class="fa fa-home"></i> Chalet <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                        <ul>
                            <li>
                                <a href="#" data-toggle="collapse" data-target="#menu-1"><i class="fa fa-home"></i> Chalet Type Status <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                                <ul id="submenu-1" class="collapse">
                                    <li><a href="add_type.php"><i class="fa fa-plus-circle"></i> Create Chalet Type </a></li>
                                    <li><a href="update_type.php"><i class="fa fa-pencil"></i> Update Chalet Type </a></li>
                                    <li><a href="delete_type.php"><i class="fa fa-trash-o"></i> Delete Chalet Type </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" data-toggle="collapse" data-target="#menu-2"><i class="fa fa-home"></i> Chalet Number Status<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                                <ul id="submenu-2" class="collapse">
                                    <li><a href="add_num.php"><i class="fa fa-plus-circle"></i> Create Chalet Number </a></li>
                                    <li><a href="update_num.php"><i class="fa fa-pencil"></i> Update Chalet Number </a></li>
                                    <li><a href="delete_num.php"><i class="fa fa-trash-o"></i> Delete Chalet Number </a></li>
                                </ul>
                            </ul>
                        </li>
                    </li>
                    <li>
                    	<a href="cottage_availability.php"><i class="fa fa-calendar"></i>Chalet Availability</a>
                    </li>
                     <li>
                        <a href="history.php"><i class="fa fa-clock-o"></i>History</a>
                    </li>
                    <li>
                        <a href="archived.php"><i class="fa fa-minus-circle"></i>Archive</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
					</ul>
            </div>
        </nav>
</body>

</html>