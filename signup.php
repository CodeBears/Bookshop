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

if(isset($_POST['submit'])){ //check if form was submitted
    if($_POST['account']==='root'){
        
        echo "你不能將account設為root";
        exit;
    }
  $sql = "INSERT INTO MEMBER(account, passwd, M_Name, M_address, birthday, M_tel) VALUES ('$_POST[account]', '$_POST[passwd]','$_POST[M_Name]','$_POST[M_address]','$_POST[birthday]', '$_POST[M_tel]');";
if (mysqli_query($con, $sql)) {
    echo "Signup successfully";
} else {
    echo "Error Insert record: " . mysqli_error($con);
}
}else{ ?>  
<div class="container-fluid">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="" method="post">

                <label>Account</label>
                <input type="text" name="account" class="form-control" placeholder="yun0003" required="required">

                <label>Password</label>
                <input type="password" name="passwd" class="form-control" placeholder="pwd00" required="required">
             
        
                <label>Name</label>
                <input type="text" name="M_Name" class="form-control" placeholder="Kevin" required="required">


                <label>Address</label>
                <input type="text" name="M_address" class="form-control" placeholder="No.3, Sec. 3, University Road, Douliu City, Yunlin" required="required">

                <label>birthday</label>
                <input type="date" name="birthday" class="form-control" required="required">

                <label>tel</label>
                <input type="tel" name="M_tel" class="form-control" placeholder="05-5555-5555" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" required="required">

                <br>
                <input type="submit" class="btn btn-primary" value="Submit" name = "submit">
                <input type="reset" class="btn btn-default" value="Reset">
                <br>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
          
        </form>
    </div>    
    </div>
<?php } ?>
  </body>
 </html>