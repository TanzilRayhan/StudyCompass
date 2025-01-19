<?php

require_once('../model/database.php');

function getNews($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM news_articles WHERE id='{$id}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function getAllNews()
{
    $con = getConnection();
    $sql = "SELECT * FROM news_articles";
    $result = mysqli_query($con, $sql);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function addNews($title, $category, $content)
{
    $conn = getConnection();
    $sql = "INSERT INTO news_articles (title, category, content)  
            VALUES ('{$title}', '{$category}', '{$content}')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return false;
    }
}

function deleteNews($id)
{
    $conn = getConnection();
    $sql = "DELETE FROM news_articles WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function updateNews($id, $title, $category, $content)
{
    $conn = getConnection();
    $sql = "UPDATE news_articles 
            SET title='{$title}', category='{$category}', content='{$content}' 
            WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return false;
    }
}

function getTotalNews()
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) AS total FROM news_articles";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}
