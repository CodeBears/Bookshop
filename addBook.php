<!DOCTYPE html>

<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if($_SESSION["name"] !== 'root'){
    echo "您沒有管理權限，你以為改個網址進得來?";
    exit;
}
?>
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
  $sql = "INSERT INTO Book (B_name, P_ID,Price,ISBN,Author) VALUES ( '$_POST[B_name]', '$_POST[P_ID]','$_POST[Price]','$_POST[ISBN]','$_POST[Author]');";
  

if (mysqli_query($con, $sql)) {
    echo "Add Record  successfully";
} else {
    echo "Error adding record: " . mysqli_error($con);
}
}else{ ?>   

<form action="" method="post">
<table class = "table table-striped">
  <tr>
    <th>Book_Name</th>
    <th>Price</th>
    <th>Publisher_ID</th>
    <th>ISBN</th>
    <th>Author</th>
  </tr>
    <tr>
    <td><input type='text' value='' name='B_name'  required="required"/></td>
    <td><input  type="number" min="1" max="9999" value='' name='Price'  required="required"/></td>
    <td>
    <select name="P_ID">
    <?php
    $sql = "SELECT * FROM publisher";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>
    <option value="<?php echo $row["P_ID"]; ?>"><?php echo $row["P_ID"]; ?></option>
    <?php }
} else {
    echo "0 results";
} ?>
  </select></td>
    <td><input type="number" value='' name='ISBN'/></td>
    <td><input type="text" value='' name='Author'/></td>
    </tr>
</table>
<input type="submit" name="SubmitButton"/>
</form> 
<?php } ?>
</body>
</html>