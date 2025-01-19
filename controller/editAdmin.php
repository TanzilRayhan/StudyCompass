<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location: ../view/login.php');
    exit();
}
require_once('../model/authModel.php');

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if (!$id) {
    echo "Admin ID is missing!";
    exit();
}

$con = getConnection();
$sql = "SELECT * FROM admins WHERE id='{$id}'";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Admin not found!";
    exit();
}

$admin = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyCompass - Home</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function validateForm() {
            var name = document.getElementById("name").value.trim();
            var email = document.getElementById("email").value.trim();
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();

            if( name === "") {
                alert("Name is required.");
                document.getElementById("name").focus();
                return false;
            }

            if (email === "") {
                alert("Email is required.");
                document.getElementById("email").focus();
                return false;
            }

            if (username === "") {
                alert("Username is required.");
                document.getElementById("username").focus();
                return false;
            }

            if (password === "") {
                alert("Password is required.");
                document.getElementById("password").focus();
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
            </ul>
        </div>
    </nav>
    <div class="form">
        <div class="form-container register-container">
            <h2>Edit Admin</h2>
            <form method="post" action="../controller/updateAdmin.php" onsubmit="return validateForm()">
                
                <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" value="<?= ($admin['name']) ?>" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?= ($admin['email']) ?>" id="email">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="reg-username">Username</label>
                        <input type="text" name="username" value="<?= ($admin['username']) ?>" id="username">
                    </div>
                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input type="password" name="password" value="<?= ($admin['password']) ?>" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <button name="submit" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
