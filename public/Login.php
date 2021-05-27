<?php
session_start();
include "../config/Database.php";

$db = new Database();
$error = "";
if(isset($_POST['submit'])){
    $username = $_SESSION['username']=$_POST['username'];
    $password = $_SESSION['password']=$_POST['password'];
    $query = "SELECT * FROM USER WHERE username = '$username' AND password = '$password'";
    $stmt = $db->selectData($query);
    $result = $stmt->get_result();
    if($result->num_rows>0){
        header("Location:showProduct.php");
    }

    $query = "SELECT * FROM USER WHERE username != '$username'";
    $stmt = $db->selectData($query);
    $result = $stmt->get_result();
    if($result->num_rows>0){
        $error = "Sai username hoặc password";
    }
    $query = "SELECT * FROM USER WHERE password != 'password'";
    $stmt = $db->selectData($query);
    $result = $stmt->get_result();
    if($result->num_rows>0){
        $error = "Sai username hoặc password";
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/main.css">
</head>
<body>
<div class="body"></div>
<div class="grad"></div>
<div class="header">
    <div>Site<span>Random</span></div>
</div>
<br>
<div class="login">
    <?php echo $error ?>
    <form action="" method="post">
    <input type="text" placeholder="username" name="username" required><br>
    <input type="password" placeholder="password" name="password" required><br>
    <input type="submit" name="submit" value="Login"><br>
        <a class="btn-signup"href="SignUp.php">Don't have an account ?,click to sign up</a>
    </form>
</div>

</body>
</html>
