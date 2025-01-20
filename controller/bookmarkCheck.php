<?php
session_start();
require_once('../model/bookmarkModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required data is present
    if (!isset($_POST['scholarship_id'], $_POST['username'])) {
        echo "Invalid request. Please provide all required fields.";
        exit;
    }

    // Sanitize input
    $scholarship_id = intval($_POST['scholarship_id']);
    $username = $_POST['username'];

    // Validate input
    if ($scholarship_id <= 0 || empty($username)) {
        echo "Invalid scholarship ID or username.";
        exit;
    }

    // Check if the scholarship is already bookmarked by the user
    if (isBookmarked($username, $scholarship_id)) {
        echo "This scholarship is already bookmarked.";
        exit;
    }

    // Add the scholarship to bookmarks
    $result = addBookmark($username, $scholarship_id);

    if ($result) {
        // Ensure no output before header
        header("Location: ../view/userScholarships.php");
        exit;
    } else {
        echo "Failed to bookmark the scholarship. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
