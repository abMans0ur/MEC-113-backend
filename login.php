<?php
include_once './conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="password" name="password" id="">
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $userEmail = mysqli_real_escape_string($conn,$_POST['email']);
    $userPassword = mysqli_real_escape_string($conn,$_POST['password']);
    $runSql = mysqli_query($conn, "SELECT*FROM`users`WHERE`user_mail`='$userEmail'");
    $fetchUser = mysqli_fetch_assoc($runSql);
    if(password_verify($userPassword,$fetchUser['password'])){
        if($fetchUser['category']=='client'){
            $_SESSION['user_id'] = $fetchUser['user_id'];
            header('location:index.php');
        }else if($fetchUser['category']=='admin'){
            header('location:');
        }
    }
}


?>