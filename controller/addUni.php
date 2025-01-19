<?php
require_once('../model/uniModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if data is received
    if (!isset($_POST['data'])) {
        echo json_encode(['success' => false, 'error' => 'No data received']);
        exit();
    }

    // Decode the JSON data
    $data = json_decode($_POST['data'], true);

    // Validate if the JSON is correctly parsed
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
        exit();
    }

    // Validate all fields
    if (empty($data['name']) || empty($data['location']) || empty($data['major']) || empty($data['website'])) {
        echo json_encode(['success' => false, 'error' => 'All fields are required!']);
        exit();
    }

    // Clean and assign data
    $name = trim($data['name']);
    $location = trim($data['location']);
    $major = trim($data['major']);
    $website = trim($data['website']);

    // Add the university to the database
    $status = addUniversity($name, $location, $major, $website);

    // Respond with success or error
    if ($status) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
    exit();
} else {
    // Handle incorrect request methods
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit();
}
