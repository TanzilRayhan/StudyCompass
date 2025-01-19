<?php
session_start();
require_once('../model/newsModel.php');

if (isset($_REQUEST['submit'])) {
    $id = $_REQUEST['id']; 
    $title = trim($_REQUEST['title']);
    $category = trim($_REQUEST['category']);
    $content = trim($_REQUEST['content']);

    if (empty($title) || empty($category) || empty($content)) {
        echo "All fields are required!";
    } else {
        $status = updateNews($id, $title, $category, $content);

        if ($status) {
            header('location: ../view/newsAdmin.php');
            exit();
        } else {
            echo "Failed to add news. Please try again.";
        }
    }
} else {
    header('location: ../view/addNews.php');
    exit();
}
?>
