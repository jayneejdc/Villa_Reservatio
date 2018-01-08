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
<form action="deluxe.php" method="POST">
    <div class="form-group">
        <label>Chalet Type: </label> 
        <select name="picked" class="form-control" required>
            <option>
                <?php
                    $query = "SELECT * FROM rooms";
                    $rre= mysqli_query($mysqli, $query);
                    while($rrow=mysqli_fetch_array($rre)){
                        $name = $rrow['name'];
                        $value = $rrow['id'];
                        echo '<option name ="id" value="'.$name.'">'.$name.'</option>';
                    }
                ?>
            </option>
        </select>
        <label>No. of Rooms: </label>
        <input type="number" name="add">
        <a href="deluxe.php"><br><br><input type="submit" name="a_new" class= "btn btn-primary" value="Add New"></a>
    </div>
</form>