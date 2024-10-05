<?php
include_once './conn.php';
include_once './auth.php';
$sort = 'DESC';
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}
$adminId = $_SESSION['user_id'];
$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` INNER JOIN `admin_roles`ON`users`.`user_id`=`admin_roles`.`user_id`  WHERE `users`.`user_id`=$adminId AND `category`='admin'  "));
$adminRoles = json_decode($admin['permissions'], true);
if(isset($_GET['userId'])&&isset($_GET['status'])){
    $userId=$_GET['userId'];
    $status=$_GET['status'];
    if($status==0){
        $newStatus = true;
    }else{
        $newStatus = false;
    }
    $updateStatus = mysqli_query($conn, "UPDATE `users` SET`is_active` = '$newStatus'  WHERE `user_id` = $userId ");
    if($updateStatus){
        header('location:admin.php');
    }else{
        echo "ERROR". mysqli_error($conn);
    }
}

// echo "<pre>";
// print_r($adminRoles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
</head>

<body>
    <h2>Welcome <?php echo $admin['username']  ?></h2>
    <?php
    $selectUser = "SELECT * FROM `users`WHERE `category`='client'";
    $today= date('Y-m-d',time());
    echo "<h2>All USERS:" . mysqli_num_rows(mysqli_query($conn, $selectUser)) . "</h2>";
    echo "<h2>All ACTIVE USERS:" . mysqli_num_rows(mysqli_query($conn, $selectUser."AND `is_active`=true")) . "</h2>";
    echo "<h2>All In-ACTIVE USERS:" . mysqli_num_rows(mysqli_query($conn, $selectUser."AND `is_active`=false")) . "</h2>";
    echo "<h2>All Created USERS for today:" . mysqli_num_rows(mysqli_query($conn, $selectUser."AND DATE(`created_at`)='$today'")) . "</h2>";
  if (in_array('create', $adminRoles['admin'])) {
    ?>
        <a href="./createAdmin.php">Add Admin</a>
    <?php
    }
    include_once './logout.php';
    ?>

    <table style="width:100%" border="1">
        <thead>
            <tr>
                <th><a href="?sort=<?php echo  $sort=='DESC'?'ASC':'DESC';   ?>">#</a></th>
                <th>Name</th>
                <th>Image</th>
                <th>E-mail</th>
                <th>Activation</th>
                <th>Joined since</th>
                <th>Last Update</th>
                <?php
                if (in_array('delete', $adminRoles['user']) || in_array('update', $adminRoles['user'])) {
                ?>
                    <th colspan="2">Action</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $clients = mysqli_query($conn, "SELECT * FROM `users` WHERE `category`='client' ORDER BY `user_id` $sort ");
            foreach ($clients as $client):
            ?>
                <tr>
                    <td><?php echo $client['user_id'] ?></td>
                    <td><?php echo $client['username'] ?></td>
                    <td><img src="<?php echo $client['user_image'] ?>" alt="" width="100" height="100"></td>
                    <td><?php echo $client['user_email'] ?></td>
                    <?php
                    if (in_array('update', $adminRoles['user'])) {
                    ?>
                        <td><a href="?userId=<?php echo$client['user_id']."&status=".$client['is_active']  ?>"><?php echo $client['is_active'] == true ? 'Activated' : "Not activated"; ?></a></td>
                    <?php
                    } else {
                    ?>
                        <td><?php echo $client['is_active'] == true ? 'Activated' : "Not activated"; ?></td>
                    <?php } ?>
                    <td><?php echo $client['created_at'] ?></td>
                    <td><?php echo $client['updated_at'] ?></td>
                    <?php
                    if (in_array('update', $adminRoles['user'])) {
                    ?>
                        <td><a href="">Update</a></td>
                    <?php
                    }
                    if (in_array('delete', $adminRoles['user'])) {
                    ?>
                        <td><a href="">Delete</a></td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</body>

</html>