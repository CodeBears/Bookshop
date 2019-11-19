<?php
// Initialize the session
session_start();
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
<table class = "table table-striped">
  <tr>
    <th>Book_ID</th>
    <th>Book_Name</th>
    <th>Price</th>
    <th>Publisher_ID</th>
    <th>ISBN</th>
    <th>Author</th>
    <th>Publisher_Name</th>
    <th>Publisher_Tel</th>
    <th>Publisher_Address</th>
    <th>BUY</th>
    <th>Quantity</th>

  </tr>
  <form action="buyBook.php" method="post">
<?php
    $sql = "SELECT * FROM book,publisher WHERE book.P_ID = publisher.P_ID";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>
    <tr>
    <td><?php echo $row["B_ID"]; ?></td>
    <td><?php echo $row["B_name"]; ?></td>
    <td><?php echo $row["Price"]; ?></td>
    <td><?php echo $row["P_ID"]; ?></td>
    <td><?php echo $row["ISBN"]; ?></td>
    <td><?php echo $row["Author"]; ?></td>
    <td><?php echo $row["P_name"]; ?></td>
    <td><?php echo $row["P_tel"]; ?></td>
    <td><?php echo $row["P_address"]; ?></td>
  
    <td><input type="checkbox" name="checkBook[]" value=<?php echo $row["B_ID"]; ?>></td>
    <td> <select name=<?php echo $row["B_ID"]; ?>>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option></td>
  </select>
  </tr>

<?php }
} else {
    echo "0 results";
} ?>
</table>

<?php  ?>
<input type="submit" value="購買書籍" name="buyBook"/>

</form>

</div>
</body>
</html>