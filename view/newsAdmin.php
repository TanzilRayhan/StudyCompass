<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}

require_once('../model/newsModel.php');

if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'fetchArticles') {
    $articles = getAllNews();

    if ($articles) {
        echo json_encode($articles);
        exit();
    } else {
        echo json_encode(['error' => 'No articles found']);
        exit();
    }
}

$totalNews = getTotalNews();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Articles</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function fetchArticles() {
            const xhr = new XMLHttpRequest();
            xhr.open('REQUEST', 'newsAdmin.php?action=fetchArticles', true);
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    renderArticles(response);
                }
            };
            xhr.send();
        }

        function renderArticles(articles) {
            const articlesContainer = document.querySelector('.news-articles');
            articlesContainer.innerHTML = "";

            articles.forEach(article => {
                const articleHTML = `
                    <article class="news-article">
                        <h2>${article.title}</h2>
                        <button class="news-btn">${article.category}</button>
                        <p>${article.content}</p>
                        <a href="../controller/editNews.php?id=${article.id}">
                            <button class="news-btn">Edit</button>
                        </a>
                        <a href="../controller/deleteNews.php?id=${article.id}">
                            <button class="news-btn delete">Delete</button>
                        </a>
                    </article>
                `;
                articlesContainer.innerHTML += articleHTML;
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetchArticles();
        });
    </script>
</head>

<body class="news-admin">
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
    <div class="news-container">
        <header class="news-header">
            <h1>Admin Dashboard - Manage News</h1>
            <nav class="news-nav">
                <a href="../view/newsArticles.php">View Articles</a>
                <a href="../view/addNews.php">Create Articles</a>
            </nav>
        </header>

        <main class="news-main">
            <section class="news-articles">
            </section>
        </main>
    </div>
</body>

</html>