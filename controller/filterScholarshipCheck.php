<?php
require_once('../model/scholarshipModel.php');
header('Content-Type: application/json');

// Get the JSON payload from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Get the filter parameters from the decoded data
$name = isset($data['name']) ? $data['name'] : '';
$university_name = isset($data['university_name']) ? $data['university_name'] : '';
$country = isset($data['country']) ? $data['country'] : '';
$budget = isset($data['budget']) ? $data['budget'] : '';
$course = isset($data['course']) ? $data['course'] : '';
$deadline = isset($data['deadline']) ? $data['deadline'] : '';

// Get the filtered scholarships from the database
$con = getConnection();
$scholarships = filterScholarships($con, $name, $university_name, $country, $budget, $course, $deadline);

// Prepare the response
$response = array();

if ($scholarships) {
    $response['success'] = true;
    $response['data'] = $scholarships;
} else {
    $response['success'] = false;
    $response['message'] = 'No scholarships found for the given filters.';
}

// Return the response as JSON
echo json_encode($response);
?>
