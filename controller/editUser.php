<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location: ../view/login.php');
    exit();
}

require_once('../model/authModel.php');

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if (!$id) {
    echo "User ID is missing!";
    exit();
}

$con = getConnection();
$sql = "SELECT * FROM users WHERE id='{$id}'";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "User not found!";
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyCompass - Home</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
    function validatePassword(password) {
        const specialChars = /[!@#$%^&*(),.?":{}|<>]/;
        const hasNumber = /\d/;

        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        if (!hasNumber.test(password)) {
            alert("Password must include at least one number.");
            return false;
        }

        if (!specialChars.test(password)) {
            alert("Password must include at least one special character.");
            return false;
        }

        return true;
    }

    function validateAge(age) {
        if (age < 16) {
            alert("You must be at least 16 years old to register.");
            return false;
        }
        return true;
    }

    function validateForm() {
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim();
        var username = document.getElementById("reg-username").value.trim();
        var password = document.getElementById("reg-password").value.trim();
        var age = document.getElementById("age").value.trim();
        var gender = document.getElementById("gender").value.trim();
        var dob = document.getElementById("dob").value.trim();
        var address = document.getElementById("address").value.trim();

        if (name === "") {
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
            document.getElementById("reg-username").focus();
            return false;
        }

        if (password === "") {
            alert("Password is required.");
            document.getElementById("reg-password").focus();
            return false;
        }

        if (!validatePassword(password)) {
            document.getElementById("reg-password").focus();
            return false;
        }

        if (age === "") {
            alert("Age is required.");
            document.getElementById("age").focus();
            return false;
        }

        if(!validateAge(age)){
            document.getElementById("age").focus();
            return false;
        }

        if (gender === "") {
            alert("Gender is required.");
            document.getElementById("gender").focus();
            return false;  
        }

        if (dob === "") {
            alert("Date of Birth is required.");
            document.getElementById("dob").focus();
            return false;
        }

        if (address === "") {
            alert("Address is required.");
            document.getElementById("address").focus();
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
            <h2>Edit User</h2>
            <form method="post" action="../controller/updateUser.php" onsubmit="return validateForm()">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <div class="row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" value="<?= ($user['name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?= ($user['email']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="reg-username">Username</label>
                        <input type="text" name="username" value="<?= ($user['username']) ?>" id="reg-username">
                    </div>
                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input type="password" name="password" value="<?= ($user['password']) ?>" id="reg-password">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" value="<?= ($user['age']) ?>" id="age">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <option value="male" <?= ($user['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= ($user['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= ($user['gender'] == 'other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" value="<?= ($user['dob']) ?>" id="dob">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="<?= ($user['address']) ?>" id="address">
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
