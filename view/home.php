<?php
session_start();
require_once('../model/authModel.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyCompass - Home</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="" id="logo">StudyCompass</a></li>
                <li><a href="">Home</a></li>
                <li><a href="../view/universitiesUser.php">Universities</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/showEvents.php">Events</a></li>
                <?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])): ?>
                    <?php
                    if (isset($_SESSION['admin'])) {
                        $username = $_SESSION['admin'];
                        $admin = getAdmin($username);
                    } elseif (isset($_SESSION['user'])) {
                        $username = $_SESSION['user'];
                        $user = getUser($username);
                    }
                    ?>

                    <?php if (isset($admin) && $admin): ?>
                        <li><a href="../view/adminDashboard.php">Admin Dashboard</a></li>
                    <?php elseif (isset($user) && $user): ?>
                        <li><a href="../view/userDashboard.php">User Dashboard</a></li>
                    <?php endif; ?>

                    <li><a href="../controller/logout.php" id="btnLogin">Logout</a></li>
                <?php else: ?>
                    <li><a href="../view/login.php" id="btnLogin">Login</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Empowering Bangladeshi Students <br> for Global Education</h1>
            <p>Your pathway to studying abroad starts here. <br>Discover universities, scholarships, and more!</p>
            <div class="hero-buttons">
                <a href="../view/login.php" class="btn primary">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <ul class="footer-links">
                <li><a href="../view/contractUs.php">Contact Us</a></li>
                <li><a href="../view/faq.php">FAQ</a></li>
                <li><a href="../view/terms.php">Terms of Service</a></li>
                <li><a href="../view/forum.php">Forum</a></li>
            </ul>
        </div>
        <div>
            <p>StudyCompass &copy; 2024. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>