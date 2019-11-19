<html>
<body>
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

 //check if form was submitted
  $sql = "DELETE FROM book  WHERE B_ID=$_POST[deleteBook]";

if (mysqli_query($con, $sql)) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    echo "Error delete record: " . mysqli_error($con);
}
   
?>
</body>
</html>