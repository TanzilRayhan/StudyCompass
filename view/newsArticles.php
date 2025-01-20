<?php
session_start();

require_once('../model/newsModel.php');
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'fetchNews') {
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
    <title>News and Articles</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function fetchNewsArticles() {
            const xhr = new XMLHttpRequest();
            xhr.open('REQUEST', 'newsArticles.php?action=fetchNews', true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    renderNewsArticles(response);
                }
            };

            xhr.send();
        }

        function renderNewsArticles(articles) {
            const newsContainer = document.querySelector('.news-articles');
            newsContainer.innerHTML = "";

            articles.forEach(article => {
                const articleHTML = `
                    <article class="news-article">
                        <h2>${article.title}</h2>
                        <button class="news-btn">${article.category}</button>
                        <p>${article.content}</p>
                    </article>
                `;
                newsContainer.innerHTML += articleHTML;
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            fetchNewsArticles();
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
            </ul>
        </div>
    </nav>
    <header class="news-header">
        <h1>News and Articles</h1>
        <p>Total Articles: <?= $totalNews; ?></p>
    </header>
    <div class="news-container">
        <main class="news-main">
            <section class="news-articles">
            </section>
        </main>
    </div>
</body>

</html>
