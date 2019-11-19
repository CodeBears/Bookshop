<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
  $sql = "UPDATE book SET B_name='$_POST[B_name]' , Price= $_POST[B_price], ISBN = '$_POST[ISBN]', Author='$_POST[Author]' WHERE B_ID=$_POST[B_id]";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
}else{ ?>   

<form action="" method="post">
<table class = "table table-striped">
  <tr>
    <th>Book_ID</th>
    <th>Book_Name</th>
    <th>Price</th>
    <th>Publisher_ID</th>
    <th>ISBN</th>
    <th>Author</th>
  </tr>

<?php
    $sql = "SELECT * FROM book WHERE book.B_ID =$_POST[updateBook]";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>

    <tr>
    <td><input readonly="readonly" type='text' value='<?php echo $row["B_ID"]; ?>' name='B_id'/></td>
    <td><input  type='text' value='<?php echo $row["B_name"]; ?>' name='B_name'  required="required"/></td>
    <td><input  type="number" min="1" max="9999" value='<?php echo $row["Price"]; ?>' name='B_price'  required="required"/></td>
    <td><input  readonly="readonly" type='text' value='<?php echo $row["P_ID"]; ?>' name='P_id'/></td>
    <td><input  type='text' value='<?php echo $row["ISBN"]; ?>' name='ISBN' required="required"/></td>
    <td><input  type='text' value='<?php echo $row["Author"]; ?>' name='Author' required="required"/></td>

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