
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Oh!DB!Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link" href="index.php">購買書籍</a>
                </li>
                <?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["name"] !== 'root'){
    ?>
                <li class="nav-item">
                    <a class="nav-link" href="orderDetail.php">訂單查詢</a>
                </li>
                <?php
}
    ?>
                <?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["name"] === 'root'){
    ?>
      
                <li class="nav-item">
                    <a class="nav-link" href="member.php">會員管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book.php">書籍管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">購買記錄管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="publisher.php">出版社管理</a>
                </li>
                
                <?php
}
    ?>
            </ul>
        </div>
        <div class="navbar-collapse collapse order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
        <?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
echo "     <li class='nav-item'>
<a class='nav-link' href='login.php'>Login</a>
</li>

<li class='nav-item'>
<a class='nav-link' href='signup.php'>SignUp</a>
</li>";
}
?>
        
            <?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
echo " <li class='nav-item'><a class='nav-link' href='logout.php'>logout</a></li>";
}
?>
         
        </ul>
    </div>
    </nav>