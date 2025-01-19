<?php


require_once('../model/scholarshipModel.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the form
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $university_name = trim($_POST['university_name']);
    $scholarship_url = trim($_POST['scholarship_url']);
    $country = trim($_POST['country']);
    $budget = trim($_POST['budget']);
    $course = trim($_POST['course']);
    $deadline = trim($_POST['deadline']);
    $eligibility = trim($_POST['eligibility']);
    $description = trim($_POST['description']);

        
    $result = updateScholarship($id, $name, $university_name, $scholarship_url, $country, $budget, $course, $deadline, $eligibility, $description);

    if ($result) {
        // Redirect to manageScholarship page after successful update
        header("Location: ../view/adminScholarships.php");
        exit;
        } else {
            echo "Error updating scholarship.";
        }
    
} else {
    // If no form submitted, redirect to the manageScholarship page
    header("Location: ../view/adminScholarships.php");
    exit;
}
?>
