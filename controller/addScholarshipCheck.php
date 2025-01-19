<?php
header('Content-Type: application/json');
require_once('../model/scholarshipModel.php'); // Include the database model file

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data (JSON) and decode it
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Check if data is received
    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        exit;
    }

    // Extract the form data
    $name = $data['name'];
    $university_name = $data['university_name'];
    $scholarship_url = $data['scholarship_url'];
    $country = $data['country'];
    $budget = $data['budget'];
    $course = $data['course'];
    $deadline = $data['deadline'];
    $eligibility = $data['eligibility'];
    $description = $data['description'];

    // Call the function to insert data into the database
    $success = addScholarship($name, $university_name, $scholarship_url, $country, $budget, $course, $deadline, $eligibility, $description);

    // Respond with success or failure based on the result
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database insert failed']);
    }
} else {
    // If the request method is not POST, return a failure response
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
