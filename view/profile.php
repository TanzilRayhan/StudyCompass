<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}

$username = $_SESSION['user'];

require_once('../model/authModel.php');

if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'fetchProfile') {
    $user = getUser($username);

    if ($user) {
        echo json_encode($user);
        exit();
    } else {
        echo json_encode(['error' => 'User data not found.']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function fetchUserProfile() {
            const xhr = new XMLHttpRequest();
            xhr.open('REQUEST', 'profile.php?action=fetchProfile', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    renderUserProfile(response);
                }
            };

            xhr.send();
        }
        function renderUserProfile(user) {
            document.getElementById('profile-name').innerText = user.name;
            document.getElementById('profile-email').innerText = user.email;
            document.getElementById('profile-username').innerText = user.username;
            document.getElementById('profile-age').innerText = user.age;
            document.getElementById('profile-dob').innerText = user.dob;
            document.getElementById('profile-gender').innerText = user.gender;
            document.getElementById('profile-address').innerText = user.address;
        }

        document.addEventListener("DOMContentLoaded", function () {
            fetchUserProfile();
        });
    </script>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="../view/universitiesUser.php">Universities</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/showEvents.php">Events</a></li>
                <li><a href="../view/userDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
        <div class="profile-card">
            <h1>Profile Information</h1>
            <table>
                <tr>
                    <th>Full Name</th>
                    <td id="profile-name"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td id="profile-email"></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td id="profile-username"></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td id="profile-age"></td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td id="profile-dob"></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td id="profile-gender"></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td id="profile-address"></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
