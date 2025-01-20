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
    <title>Forum</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/forum.css">
    <script>
        // Fetch posts via AJAX
        function fetchPosts() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '../controller/forumController.php?action=fetchPosts', true);
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    renderPosts(response);
                }
            };
            xhr.send();
        }

        // Render posts dynamically
        function renderPosts(posts) {
            const postsContainer = document.querySelector('.forum-posts');
            postsContainer.innerHTML = "";

            posts.forEach(post => {
                const postHTML = `
                    <div class="forum-post">
                        <h2>${post.title}</h2>
                        <p>${post.content}</p>
                        <p><strong>Author:</strong> ${post.author}</p>
                        <div class="forum-actions">
                            <button>👍 ${post.likes}</button>
                            <button>👎 ${post.dislikes}</button>
                        </div>
                    </div>
                `;
                postsContainer.innerHTML += postHTML;
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetchPosts();
        });
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
            </ul>
        </div>
    </nav>

    <div class="forum-container">
        <h1>Forum Posts</h1>
        <div style="text-align: center; margin-bottom: 20px;">
            <button onclick="window.location.href='createPost.php'" class="addArticles-btn">Create Post</button>
        </div>
        <div class="forum-posts">
            <!-- Posts will be dynamically added here -->
        </div>
    </div>
</body>

</html>