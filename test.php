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

    $sql = "SELECT * FROM book";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "bid: " . $row["B_ID"]. " bName: " . $row["B_name"]. " price:" . $row["Price"]. "<br>";
    }
} else {
    echo "0 results";
}
    mysqli_close($con);
?>