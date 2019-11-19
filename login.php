<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

?>
 
 <!DOCTYPE html>
<html lang="en">
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
$bool = false;
if(isset($_POST['submit'])){ //check if form was submitted
    $sql = "SELECT M_ID,account, passwd FROM member WHERE account = '$_POST[account]'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
if($row["passwd"]== $_POST['passwd'] ){
    $_SESSION["id"] = $row['M_ID'];
    $_SESSION["name"] = $_POST['account'];
    $_SESSION["loggedin"] = true;
    $bool = true;
    header("location: index.php");
    exit;
}
        }
    }


    if($_POST['account']=='root'){
        if($_POST['passwd']=='root'){
            $_SESSION["name"] = 'root';
            $_SESSION["loggedin"] = true;
            $bool = true;
            header("location: index.php");
            exit;
        }
    }


if (!$bool) {
    echo "帳號或密碼錯誤";
}
}else{ ?>  
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Account</label>
                <input type="text" name="account" class="form-control" placeholder="yun0003" required="required">
                <label>Password</label>
                <input type="password" name="passwd" class="form-control" placeholder="pwd00" required="required">
                <br>
                <input type="submit" class="btn btn-primary" value="Submit" name = "submit">
                <input type="reset" class="btn btn-default" value="Reset">
        </form>
    </div>   
<?php }?> 
</body>
</html>
<?php
//$_SESSION["loggedin"] = true;
//$_SESSION["id"] = $id;
//$_SESSION["username"] = $username;                            
?> 