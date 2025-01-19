<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function validateForm() {
            var title = document.getElementById("title").value.trim();
            var category = document.getElementById("category").value.trim();
            var content = document.getElementById("content").value.trim();

            if (title === "") {
                alert("Title is required.");
                document.getElementById("title").focus();
                return false;
            }

            if (category === "") {
                alert("Category is required.");
                document.getElementById("category").focus();
                return false;
            }

            if (content === "") {
                alert("Content is required.");
                document.getElementById("content").focus();
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
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/adminDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <div class="addArticles-container">
        <header class="addArticles-header">
            <h1>Add New Article</h1>
        </header>
        <main class="addArticles-main">
            <form method="post" action="../controller/createNews.php" class="addArticles-form" onsubmit="return validateForm()">
                <div class="addArticles-group">
                    <label for="title">Article Title</label>
                    <input type="text" id="title" name="title">
                </div>

                <div class="addArticles-group">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option name="category" value="">Select</option>
                        <option name="category" value="Scholarships">Scholarships</option>
                        <option name="category" value="Visa Updates">Visa Updates</option>
                        <option name="category" value="University Rankings">University Rankings</option>
                        <option name="category" value="Tips and Stories">Tips and Stories</option>
                    </select>
                </div>

                <div class="addArticles-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="8"></textarea>
                </div>

                <div class="addArticles-buttons">
                    <button name="submit" type="submit" class="addArticles-btn">Submit</button>
                    <button type="reset" class="addArticles-btn reset">Reset</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>