<?php

require_once('../model/database.php');

function getPosts() {
    $conn = getConnection();
    $sql = "
        SELECT posts.*,
               COALESCE(like_count, 0) AS likes,
               COALESCE(dislike_count, 0) AS dislikes
        FROM posts
        LEFT JOIN (
            SELECT post_id, COUNT(*) AS like_count
            FROM reactions
            WHERE reaction_type = 'like'
            GROUP BY post_id
        ) likes ON posts.id = likes.post_id
        LEFT JOIN (
            SELECT post_id, COUNT(*) AS dislike_count
            FROM reactions
            WHERE reaction_type = 'dislike'
            GROUP BY post_id
        ) dislikes ON posts.id = dislikes.post_id
        ORDER BY posts.id DESC
    ";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    return $posts;
}

function addPost($title, $content, $author_id, $author_type) {
    $conn = getConnection();
    $sql = "INSERT INTO posts (title, content, author_id, author_type) VALUES ('{$title}', '{$content}', '{$author_id}', '{$author_type}')";
    return mysqli_query($conn, $sql);
}

function reactToPost($post_id, $user_id, $reaction) {
    $conn = getConnection();
    $sql = "SELECT * FROM reactions WHERE post_id='{$post_id}' AND user_id='{$user_id}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE reactions SET reaction_type='{$reaction}' WHERE post_id='{$post_id}' AND user_id='{$user_id}'";
    } else {
        $sql = "INSERT INTO reactions (post_id, user_id, reaction_type) VALUES ('{$post_id}', '{$user_id}', '{$reaction}')";
    }
    return mysqli_query($conn, $sql);
}
?>
