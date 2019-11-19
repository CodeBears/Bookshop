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
    $sql = "SELECT member.M_name,member.M_address,member.M_tel,orderhistory.O_ID,orderhistory.M_ID,orderhistory.M_Count,orderhistory.M_Amount,orderhistory.Date FROM member,orderhistory WHERE Member.M_ID = '$_SESSION[id]' AND Member.M_ID = orderhistory.M_ID";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>
    <table class = "table table-striped">
        <thead>
            
      
  <tr>
    <th>訂購姓名</th>
    <th>訂購電話</th>
    <th>訂購地址</th>
    <th>訂單數量</th>
    <th>訂單金額</th>
    <th>訂單日期</th>
    <th>刪除</th>
  </tr>
  </thead>
  <tbody>
  <tr  class= "classSucess" data-toggle="collapse" data-toggle="collapse" data-target=".order<?php echo $row['O_ID']?>">
    <td><?php echo $row["M_name"]; ?></td>
    <td><?php echo $row["M_tel"]; ?></td>
    <td><?php echo $row["M_address"]; ?></td>
    <td><?php echo $row["M_Count"]; ?></td>
    <td><?php echo $row["M_Amount"]; ?></td>
    <td><?php echo $row["Date"]; ?></td>
<form action="deleteOrder.php" method="post">
  <input type="hidden" value="<?php echo $row["O_ID"]; ?> " name="deleteOrder"/>
　<td><input type="submit" value="取消訂單" name="delete"/></td>
</form>
  </tr>
  </tbody>
  </table>
  <table class="table collapse order<?php echo $row['O_ID']?> col-centered" style="width:70%;text-align:center;">
            <thead class="thead-dark">
            <tr >
                <th scope="col">購買的書籍</th>
                <th scope="col">書籍數量</th>
                <th scope="col">書籍總價</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
    $sql = "SELECT book.B_name,orderdetail.OD_Count, orderdetail.OD_Amount FROM  book,orderdetail WHERE orderdetail.O_ID = '$row[O_ID]' AND orderdetail.B_ID = book.B_ID";
$resultsq = $con->query($sql);

if ($resultsq->num_rows > 0) {
    // output data of each row
    while($rows = $resultsq->fetch_assoc()) {
    ?>
            <tr class= "classSucess" >
                <td><?php echo $rows["B_name"]; ?> </td>
                <td><?php echo $rows["OD_Count"]; ?> </td>
                <td><?php echo $rows["OD_Amount"]; ?> </td>
    
            </tr>
            <?php }
} else {
    echo "查無資料";
} ?>
            </tbody>
        </table>


<?php }
} else {
    echo "您沒有訂單";
} ?>

</div>
</body>

</html>