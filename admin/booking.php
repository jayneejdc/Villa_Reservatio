<?php include 'header.php';
  include_once("connection.php");
?>
<br><br>
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
<html>
  <head>
    <title>Villa Reservatio | Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>
    <br><br>
    <div class="row" style="margin-left: 4%;">
      <!--<hr class="hr-primary" /> -->
      <ol class="breadcrumb bread-primary ">
        <button href="#" data-toggle="modal" data-target="#bannerformmodal" class="btn btn-primary"><i class="fa fa-newspaper-o"></i> Add Room Type</button>

        <button href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary"><i class="fa fa-newspaper-o"></i> Add Room Number</button>
              
      </ol>
    </div>

    <div style="margin-left: -20%;">
      <table id="myTable">  
        <thead>  
          <tr style="background-color: grey; color: rgb(255, 215, 32);">
            <td>Chalet Type</td>
            <td>Chalet Number</td>
            <td>Lastname</td>
            <td>Firstname</td>
            <td>Check-in</td>
            <td>Contact</td>
            <td>Status</td>
          </tr>
        </thead>
        <tbody>
          <?php
           $query = "SELECT * FROM chalet ORDER BY num";
           $result = mysqli_query($mysqli, $query);
           while ($row = mysqli_fetch_array($result)) :
              if (!empty($row[1])) :?>
           <tr>
                <form method="post" action="samok.php">
                      <td><?php echo $row[0]?></td>
                      <td><?php echo $row[1]?></td>
                      <td><?php echo $row[2]?></td>
                      <td><?php echo $row[3]?></td>
                      <td><?php echo $row[4]?></td>
                      <td><?php echo $row[5]?></td>
                      <td><input type="submit" class="btn btn-danger" name="action" value="Checkout"/></td>
                      <input type="hidden" class="btn btn-danger" name="picked" value="<?php echo $row['num']; ?>"/>

                </form>
              </tr>
              <?php endif; ?>
              <?php endwhile; ?>
        </tbody>
     </table>
   </div>

    <!-- ADD ROOM NUMBER MODAL-->
    

   <!-- ADD ROOM NUMBER MODAL-->
  <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Rooms</h4>
              </div>
              <div class="modal-body">
                <form action="deluxe.php" method="POST">
                  <input type="number" name="add">
                  <input type="submit" value="Add">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div> 

  <!-- ADD ROOM TYPE MODAL-->


<div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="bannerformmodal" style="margin-top: 2%;">
<div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="font-size: 120%;"><img src="user.jpg" style="border-radius: 50%; width:13%; height:13%;"> Add Employee Account</h4>
                </div>
                <div class="modal-body">
                     <form action="register.php" method="POST" enctype="multipart/form-data" autocomplete="off" style="margin-top: -10%;">
                            <div class="alert alert-error"></div>
                               <div id="add-rt-content">
                            <div>
                                <form action="add_room_type.php" method="post">
                                  Chalet's Number: <input id="ch_num" name="ch_num"  required>
                                  </br>
                                  Description: <input id="des" name="des" required >
                                  </br>
                                  Price: <input id="price" name="price"  required>
                                  </br>
                                  <button name="add-ch" value=1>Add Chalet</button>
                                </form>
                              </div>
                            </div>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name=$_POST['name'];
      $price=$_POST['price'];
      $desc=$_POST['desc'];
      $avatar_path = $mysqli->real_escape_string('Images/'.$_FILES['avatar']['name']);
            if (preg_match("!image!",$_FILES['avatar']['type'])) {
                if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                    $sql="INSERT INTO  rooms (name, price, description, avatar) VALUES ('$name', '$price', '$desc', '$avatar_path');";
                    if ($mysqli->query($sql)){
                      
                    }
                }
            }
        }
    ?>                        
  </body>

  <script type="text/javascript">
      $(document).on('click','.status_checks',function(){
      var num = ($(this).hasClass("btn-success")) ? '0' : '1';
      var msg = (num=='0')? 'checkout' : 'checkout';
      if(confirm("Are you sure to "+ msg)){
        var current_element = $(this);
        url = "ajax_checkout.php";
        $.ajax_check({
        type:"POST",
        url: url,
        data: {num:$(current_element).attr('data'),num:num},
        success: function(data)
          {   
            location.reload();
          }
        });
        }      
});

</script>
  
  <script>
    function OpenAlert(){
          alert("Are you sure to CHECK-OUT? ");
          document.getElementById("getMessage").style.visibility="hidden";       
    }
 </script>
 <script>
    $(document).ready(function(){
      $('#myTable').dataTable();
    });
  </script>



<!-- CSS -->
  <style type="text/css">
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);

    hr {
      height: 4px;
      margin-left: 15px;
      margin-bottom:-3px;
      width: 50%;
    }

    .hr-primary{
      background-image: -webkit-linear-gradient(left, rgba(66,133,244,.8), rgba(66, 133, 244,.6), rgba(0,0,0,0));
    }


    .breadcrumb {
      background: rgba(245, 245, 245, 0); 
      border: 0px solid rgba(245, 245, 245, 1); 
      border-radius: 25px; 
      display: block;
    }

    .btn-bread{
      margin-top:10px;
      font-size: 12px;
      border-radius: 3px;
    }
  </style>
</html>
