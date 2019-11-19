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
if($_SESSION["name"] === 'root'){
    echo "您管理員跟人家買甚麼書";
}else{
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
    $con=mysqli_connect($servername,$username,$password,"bookstore");
    if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if(isset($_POST['checkBook'])) {
if($_POST["checkBook"] != NULL){
    $count = 0;
    $amount = 0;
    foreach ($_POST["checkBook"] as $value){
      
        $count =$count + $_POST[$value];
        $sql = "SELECT price FROM book WHERE book.B_ID = $value";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $amount =   $amount + ($row['price']*$_POST[$value]);
            }
        }else {
            echo "0 results";
        }
        $now = date('Y-m-d');
      }
      $sql = "INSERT INTO orderhistory( M_ID, M_Count,M_Amount,Date) VALUES ( '$_SESSION[id]', $count,$amount,'$now')";
      if (mysqli_query($con, $sql)) {
        $last_id = mysqli_insert_id($con);
          echo "Buy successfully";
      } else {
          echo "Error adding record: " . mysqli_error($con);
      }
    foreach ($_POST["checkBook"] as $value){
      
        $count =$count + $_POST[$value];
        $sql = "SELECT price FROM book WHERE book.B_ID = $value";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $amount =   $row['price']*$_POST[$value];
                $sql = "INSERT INTO orderdetail( O_ID,B_ID,OD_Count,OD_Amount) VALUES ( $last_id,$value, '$_POST[$value]',$amount)";
                if (mysqli_query($con, $sql)) {
                    echo "Buy successfully";
                } else {
                    echo "Error adding record: " . mysqli_error($con);
                }
            }
        }else {
            echo "0 results";
        }
        $now = date('Y-m-d');
      }
      
    
}
}else{
    echo "你啥都沒買";
}
  ?>
</form>
<?php } ?>
</div>
</body>
</html>