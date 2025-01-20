<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - StudyCompass</title>
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
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="../view/universitiesUser.php">Universities</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/showEvents.php">Events</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/adminDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <div class="form">
        <div class="form-container register-container">
            <h2>Admin Register</h2>
            <hr>
            <form method="post" action="../controller/createAdmin.php" onsubmit="return validateForm()">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="reg-username">Username</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <button name="submit" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>