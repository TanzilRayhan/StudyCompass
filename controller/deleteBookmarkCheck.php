<?php
session_start();
require_once('../model/bookmarkModel.php');

// Check if the user is logged in and has a 'username' set in the session
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}

// Retrieve username from the session
$username = $_SESSION['user'];

// Check if 'delete' parameter is passed
if (isset($_GET['delete'])) {
    $scholarship_id = $_GET['delete'];

    // Call function to remove the bookmark
    if (removeBookmark($username, $scholarship_id)) {
        // Redirect back to bookmarks page after successful deletion
        header("Location: ../view/userBookmark.php");
        exit();
    } else {
        echo "Error deleting bookmark.";
    }
} else {
    // If no delete parameter, redirect to bookmarks page
    header("Location: ../view/userBookmark.php");
    exit();
}
?>
