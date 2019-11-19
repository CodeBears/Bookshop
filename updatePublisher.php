<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if($_SESSION["name"] !== 'root'){
    echo "您沒有管理權限，你以為改個網址進得來?";
    exit;
}
?>
<!DOCTYPE html>


<html>
<head>
    <title>Oh!DB!Shop|Member</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style type="text/css">
        @import "main.css";
    </style>

</head>
<body>
<div class="container-fluid">
<?php include("includes/navigation.php");?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
    $con=mysqli_connect($servername,$username,$password,"bookstore");
    if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  ?>
<?php    

if(isset($_POST['SubmitButton'])){ //check if form was submitted
  $sql = "UPDATE Publisher SET P_name='$_POST[P_name]' , P_tel= '$_POST[P_tel]', P_address = '$_POST[P_address]' WHERE P_ID=$_POST[P_ID]";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
}else{ ?>   

<form action="" method="post">
<table class = "table table-striped">
  <tr>
    <th>Publisher_Id</th>
    <th>Publisher_Name</th>
    <th>Publisher_Tel</th>
    <th>Publisher_Address</th>
  </tr>
<?php
    $sql = "SELECT * FROM publisher WHERE P_ID =$_POST[updatePublisher]";
  
$result = $con->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>

    <tr>
    <td><input readonly="readonly" type='text' value='<?php echo $row["P_ID"]; ?>' name='P_ID'/></td>
    <td><input  type='text' value='<?php echo $row["P_name"]; ?>' name='P_name' required="required"/></td>
    <td><input  type='tel' pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" value='<?php echo $row["P_tel"]; ?>' name='P_tel'  required="required"/></td>
    <td><input  type='text' value='<?php echo $row["P_address"]; ?>' name='P_address' required="required"/></td>


    </tr>


<?php }
} else {
    echo "0 results";
} ?>

</table>

<input type="submit" name="SubmitButton"/>
</form> 
<?php } ?>
</body>
</html>