<?php
include_once './conn.php';
include_once './auth.php';

if(isset($_GET['logout'])){
    session_destroy();
    header('location:./registeration.php');
}
$userId = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id`='$userId' limit 1"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <img src="<?php echo $user['user_image'] ?>" width="200" height="200" alt="">
    <h2>Name:<?php echo $user['username']; ?></h2>
    <h4>Email:<?php echo $user['user_email']; ?></h4>
    <h2>Joined since:<?php echo $user['created_at']; ?></h2>
    <a href="?logout">Logout</a>
</body>

</html>