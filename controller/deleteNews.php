<?php
session_start();
require_once('../model/newsModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $status = deleteNews($id);
    if ($status) {
        echo "news Deleted Successfully!";
        header('location: ../view/newsAdmin.php'); 
        exit();
    } else {
        echo "Failed to Delete News.";
    }
} else {
    echo "Invalid Request!";
    header('location: ../view/home.php');
}
?>
