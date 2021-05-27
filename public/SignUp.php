<?php
    session_start();
include "../config/Database.php";
    $db = new Database();
    $error = "";
    $error1 = "";

if(isset($_POST['submit'])){
    $username = $_SESSION['username'] =  $_POST['username'];
    $email = $_SESSION['email'] = $_POST['email'];
    $password = $_SESSION['password'] = $_POST['password'];
    $query = "SELECT * FROM USER WHERE username = '$username' OR email = '$email'";
    $stmt = $db->selectData($query);
    $result = $stmt->get_result();
    if($result->num_rows==0){
        $query = "INSERT INTO USER(username,password,email) VALUES('$username','$password','$email')";
        $stmt = $db->selectData($query);
        header("Location:Login.php");
    }
}
    if(isset($_POST['username'])){
        $username = $_SESSION['username'] = $_POST['username'];
        $query = "SELECT * FROM USER WHERE username = ?";
        $param = $username;
        $stmt = $db->selectDataParam($query,$param);
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $error =  "username đã tồn tại";
        }
        if(isset($_POST['email'])){
            $email = $_SESSION['email'] = $_POST['email'];
            $query = "SELECT * FROM USER WHERE email = ?";
            $param = $email;
            $stmt = $db->selectDataParam($query,$param);
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $error1 =  "email đã được đăng kí";
            }
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
    <form action="" method="post">
        <?php echo $error ."<br>" .$error1 ?>
        <input type="text" placeholder="username" name="username" required><br>
        <input type="password" placeholder="password" name="password" required><br>
        <input type="email" placeholder="email" name="email" required><br>
        <input type="submit" name="submit" value="Sign up"><br>
        <a class="btn-Login"href="Login.php">Already have an account,click to log in</a>
    </form>
</div>

</body>
</html>
