<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>

 <body>
 <?php
   $host = "localhost";
   $port = 3308;
   $username = "root";
   $password = "";
   $database = "cuny_adress";

   $conn = new mysqli($host, $username, $password, $database, $port);
  // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
<div style="justify-content: center;      align-items: center;">
<h1>Search Cuny Colleges</h1>
</div>

    <br/>
    <br/>
    <br/>

  <label for="sel1">Select College:</label>
  <form action="" method="post">
  <select  name="school">

      <?php
  $sql = "SELECT * FROM cuny_colleges";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      echo     "<option value='".$row['College']."'>".$row['College']."</option>";      
       
      }
  } else {
    echo "0 results";
  }
  ?>
    </select>
    <input type="submit" name="submit" value="Search"></input>

    </form>

<?php
 if ( isset( $_POST['submit']) ) {
  $choice=$_POST['school'];
  $sql = "SELECT Latitude,Longitude FROM cuny_colleges WHERE College='$choice' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
      $latitude = $row['Latitude'];
        $longitude =   $row['Longitude'];
      echo "<h1>".$choice."</h1>";
      }
  
    }
    else {
      echo "not found";
    }
    }
    $conn->close();

?>

<iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>


</body>



</html>
