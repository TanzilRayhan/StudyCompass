<?php
require_once('../model/database.php');

// Get all forum posts with reactions
function getAllPosts() {
    $conn = getConnection();
    $sql = "
        SELECT posts.id, posts.title, posts.content, posts.author, 
               COALESCE(like_count, 0) AS likes, 
               COALESCE(dislike_count, 0) AS dislikes
        FROM posts
        LEFT JOIN (
            SELECT post_id, COUNT(*) AS like_count
            FROM reactions
            WHERE reaction_type = 'like'
            GROUP BY post_id
        ) AS likes ON posts.id = likes.post_id
        LEFT JOIN (
            SELECT post_id, COUNT(*) AS dislike_count
            FROM reactions
            WHERE reaction_type = 'dislike'
            GROUP BY post_id
        ) AS dislikes ON posts.id = dislikes.post_id
        ORDER BY posts.id DESC
    ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return [];
    }

    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    return $posts;
}
function createPost($title, $content, $author) {
    $conn = getConnection();
    $sql = "INSERT INTO posts (title, content, author) VALUES ('$title', '$content', '$author')";
    return mysqli_query($conn, $sql);
}
?>
