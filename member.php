

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
if($_SESSION["name"] !== 'root'){
    echo "您沒有管理權限";
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
  ?>
<table class = "table table-striped">
  <tr>
    <th>Member_id</th>
    <th>Account</th>
    <th>Password</th>
    <th>Member_Name</th>
    <th>Member_Address</th>
    <th>Member_Birthday</th>
    <th>Member_Tel</th>
    <th>修改</th>
    <th>刪除</th>
  </tr>

<?php
    $sql = "SELECT * FROM member";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>
    <tr>
    <td><?php echo $row["M_ID"]; ?></td>
    <td><?php echo $row["account"]; ?></td>
    <td><?php echo $row["passwd"]; ?></td>
    <td><?php echo $row["M_Name"]; ?></td>
    <td><?php echo $row["M_address"]; ?></td>
    <td><?php echo $row["birthday"]; ?></td>
    <td><?php echo $row["M_tel"]; ?></td>
    <form action="updateMember.php" method="post">
    <input type="hidden" value="<?php echo $row["M_ID"]; ?>" name="updateMember"/>
　<td><input type="submit" value="修改" name="update"/></td>
</form>
<form action="deleteMember.php" method="post">
  <input type="hidden" value="<?php echo $row["M_ID"]; ?>" name="deleteMember"/>
　<td><input type="submit" value="刪除" name="delete"/></td>
</form>
  </tr>

<?php }
} else {
    echo "0 results";
} ?>
</table>

<?php } ?>
</div>
</body>
</html>