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
  $sql = "UPDATE member SET account='$_POST[account]', passwd= '$_POST[passwd]', M_Name = '$_POST[M_name]',M_address = '$_POST[M_address]', birthday = '$_POST[birthday]', M_tel ='$_POST[M_tel]'  WHERE M_ID=$_POST[M_id]";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
}else{ ?>   

<form action="" method="post">
<table class = "table table-striped">
  <tr>
    <th>Member_id</th>
    <th>Account</th>
    <th>Password</th>
    <th>Member_Name</th>
    <th>Member_Address</th>
    <th>Member_Birthday</th>
    <th>Member_Tel</th>
  </tr>

<?php
    $sql = "SELECT * FROM member WHERE M_ID =$_POST[updateMember]";
  
$result = $con->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>

    <tr>
    <td><input  readonly="readonly" type='text' value='<?php echo $row["M_ID"]; ?>' name='M_id'/></td>
    <td><input  type="text" value='<?php echo $row["account"]; ?>' name='account'  required="required"/></td>
    <td><input  type="text" value='<?php echo $row["passwd"]; ?>' name='passwd' required="required"/></td>
    <td><input  type="text" value='<?php echo $row["M_Name"]; ?>' name='M_name'  required="required"/></td>
    <td><input  type="text" value='<?php echo $row["M_address"]; ?>' name='M_address' required="required"/></td>
    <td><input  type="date" value='<?php echo $row["birthday"]; ?>' name='birthday' required="required"/></td>
    <td><input  type="tel"  pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" value='<?php echo $row["M_tel"]; ?>' name='M_tel' required="required"/></td>
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