<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}
$username = $_SESSION['user'];
require_once('../model/authModel.php');

function fetchUserData($username)
{
    $user = getUser($username);
    if ($user) {
        return json_encode($user);
    }
    return json_encode(['error' => 'User not found']);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'fetchUserData') {
    echo fetchUserData($username);
    exit();
}
$user = getUser($username);
if (!$user) {
    echo "Error: User data not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function fetchUserProfile() {
            const xhr = new XMLHttpRequest();
            xhr.open('REQUEST', 'userDashboard.php?action=fetchUserData', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    document.getElementById("profile-name").innerText = response.name;
                    document.getElementById("profile-email").innerText = response.email;
                    document.getElementById("profile-age").innerText = response.age;
                    document.getElementById("profile-dob").innerText = response.dob;
                }
            };
            xhr.send();
        }

        document.addEventListener("DOMContentLoaded", function() {
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
                <li><a href="../view/profile.php" id="btnReg">Profile</a></li>
            </ul>
        </div>
    </nav>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <hr>
            <nav>
                <ul>
                    <li><a href="../view/profile.php">Profile Information</a></li>    
                    <li><a href="../view/userScholarships.php">Scholarships</a></li>
                    <li><a href="../view/universitiesUser.php">Universities</a></li>
                    <li><a href="../view/document.php">Documents</a></li>
                    <li><a href="../view/userApplicationTracker.php">Application Tracker</a></li>
                    <li><a href="../view/userBookmark.php">Bookmarks</a></li>
                    <li><a href="../view/budgetEstimator.php">Budget Estimator</a></li>
                    <li><a href="../controller/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <h1>Welcome, <?= $user['username'] ?></h1>
            <section id="userWidget" class="profile-info">
                <h2>Profile Information</h2>
                <p><strong>Name:</strong> <span id="profile-name"></span></p>
                <p><strong>Email:</strong> <span id="profile-email"></span></p>
                <p><strong>Age:</strong> <span id="profile-age"></span></p>
                <p><strong>Date of Birth:</strong> <span id="profile-dob"></span></p>
                <a id="userButton" href="../controller/editUser.php?id=<?= $user['id'] ?>">Edit Profile</a>
            </section>
            <section id="userWidget" class="bookmarks">
                <h2>Bookmarks</h2>
                <ul>
                    <li>Harvard University</li>
                    <li>AI and Machine Learning Scholarship</li>
                    <li>10 Tips for Effective Study</li>
                </ul>
                <a id="userButton" href="../view/userBookmark.php">Manage Bookmarks</a>
            </section>
            <section id="userWidget" class="notifications">
                <h2>Recent Notifications</h2>
                <ul>
                    <li>Application deadline for Stanford closes in 5 days</li>
                    <li>Your scholarship application has been approved</li>
                    <li>New article on Data Science available</li>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>