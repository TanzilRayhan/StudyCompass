<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="../assets/styles.css">
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
            </ul>
        </div>
    </nav>

    <div class="form-container">
        <h1>Create Post</h1>
        <form method="post" id="createPostForm">
            <div class="addArticles-group">
                <label for="username">Your Username</label>
            </div>

            <div class="addArticles-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="addArticles-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="5"></textarea>
            </div>
            <div class="addArticles-buttons">
                <button type="submit" class="addArticles-btn">Submit</button>
                <button type="button" class="addArticles-btn" onclick="window.location.href='forum.php'">Back</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('createPostForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            const username = document.getElementById('username').value.trim();
            if (!title || !content) {
                alert("All fields are required!");
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/forumController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Post created successfully!");
                        window.location.href = 'forum.php';
                    } else {
                        alert(response.error || "An error occurred!");
                    }
                }
            };

            xhr.send(JSON.stringify({ action: 'createPost', title, content ,username }));
        });
    </script>
</body>

</html>