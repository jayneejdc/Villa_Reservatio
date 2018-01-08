<?php include 'header.php';?>>
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
	<title></title>
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body style="margin-top: 7%; margin-left: -10%;">
	<table id="myTable">  
    <thead>  
      <tr style="background-color: grey; color: rgb(255, 215, 32); text-align: center;">  
        <th>CHALET NUMBER</th>  
        <th>FIRST NAME</th>  
        <th>LAST NAME</th>  
        <th>CHECK-IN</th>   
        <th>CONTACT</th>  
      </tr>
    </thead>
    <tbody>
      <?php $query = "SELECT * FROM chalet ORDER BY num";
        $result = mysqli_query($mysqli, $query);
        while ($row = mysqli_fetch_array($result)) :
          if (!empty($row[1])) :
      ?>
      <tr>
       		<td><?php echo $row[0]?></td>
          <td><?php echo $row[1]?></td>
          <td><?php echo $row[2]?></td>
          <td><?php echo $row[3]?></td>
          <td><?php echo $row[4]?></td>
      </tr>
      <?php endif; ?>
      <?php endwhile;?>
    </tbody>  
  </table>
  <script>
    $(document).ready(function(){
      $('#myTable').dataTable();
      });
  </script>
</body>
</html>