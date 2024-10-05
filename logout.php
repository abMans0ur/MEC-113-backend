<?php
if(isset($_GET['logout'])){
    session_destroy();
    header('location:./registeration.php');
}
?>

<a href="?logout">Logout</a>