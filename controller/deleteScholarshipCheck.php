<?php

require_once('../model/scholarshipModel.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Call a function to delete the scholarship from the database
    deleteScholarship($id);

    // Redirect to manageScholarship.php after deletion
    header("Location: ../view/adminScholarships.php");
    exit;
} else {
    // If no ID is provided, redirect to manageScholarship page
    header("Location: ../view/adminScholarships.php");
    exit;
}
?>
