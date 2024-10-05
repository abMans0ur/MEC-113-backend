<?php
include_once './conn.php';
include_once './auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="username" required>
        <input type="email" name="userMail" required>
        <input type="password" name="password" required>
        <input type="file" name="userImage" accept="image/*" id="">
        <select name="adminRole" id="">
            <option value="low">Low Admin</option>
            <option value="mid">mid Admin</option>
            <option value="super">super Admin</option>
        </select>
        <button type="submit" name="addAdmin">add admin</button>

    </form>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['username']) && empty($_POST['username'])) {
        $errors['username'] = "User name is required";
    }
    if (!isset($_POST['userMail']) && empty($_POST['userMail'])) {
        $errors['userMail'] = "Email is required";
    }
    $roles = [];
    $adminRoles = $_POST['adminRole'];
    if ($adminRoles == 'low') {
        $roles = ['admin' => ['read'], 'user' => ['read', 'create']];
    } elseif ($adminRoles == 'mid') {
        $roles = ['admin' => ['read'], 'user' => ['read', 'create', 'update', 'delete']];
    } elseif ($adminRoles == 'super') {
        $roles = ['user' => ['read', 'create', 'update', 'delete'], 'admin' => ['read', 'create', 'update', 'delete']];
    }
    $roles = json_encode($roles);

    // variables
    $userName = $_POST['username'];
    $userMail = $_POST['userMail'];
    $userPassword = $_POST['password'];
    $checkMail = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users`WHERE `user_email`='$userMail'"));
    if ($checkMail > 0) {
        $errors['mail_repeated'] = "This email already exists";
    }
    if (strlen($userPassword) < 8) {
        $errors['password_length'] = "Password must exceeds 8 characters";
    }
    $userPassword = password_hash($userPassword, PASSWORD_BCRYPT);
    // image upload
    $targetDir = "./uploads/";
    $extension = pathinfo(strtolower($_FILES['userImage']['name']), PATHINFO_EXTENSION);
    $targetFile = uniqid() . '_' . time() . '.' . $extension;
    $uploadedFile = $targetDir . $targetFile;
    if ($_FILES['userImage']['size'] > 5000000) {
        $errors['image_size'] = 'The uploaded file is larger than 5 MB';
    }
    if (empty($errors)) {
        move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadedFile);
        $insertUser = "INSERT INTO `users`(`username`,`user_email`,`password`,`user_image`,`category`)
                        VALUES('$userName','$userMail','$userPassword','$uploadedFile','admin')";
        $runInsert = mysqli_query($conn, $insertUser);
        $createdAdminId = mysqli_insert_id($conn);
        $insertRoles = "INSERT INTO `admin_roles`(`user_id`,`role_name`,`permissions`)VALUES($createdAdminId,'$adminRoles','$roles')";
        $runInsertRoles = mysqli_query($conn, $insertRoles);
        if (!$runInsert) {
            echo mysqli_error($conn);
        }
        // $_SESSION['user_id'] = mysqli_insert_id($conn);
        header('location:admin.php');
    } else {
        foreach ($errors as $error) {
            echo "<h2>$error</h2>";
        }
    }
}
?>