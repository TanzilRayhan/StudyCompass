<?php
require_once('../model/uniModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if data is received
    if (!isset($_POST['data'])) {
        echo json_encode(['success' => false, 'error' => 'No data received']);
        exit();
    }

    // Decode JSON data
    $data = json_decode($_POST['data'], true);

    // Validate JSON format
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
        exit();
    }

    // Validate required fields
    if (empty($data['id']) || empty($data['name']) || empty($data['location']) || empty($data['major']) || empty($data['website'])) {
        echo json_encode(['success' => false, 'error' => 'All fields are required']);
        exit();
    }

    // Clean and assign data
    $id = intval($data['id']);
    $name = trim($data['name']);
    $location = trim($data['location']);
    $major = trim($data['major']);
    $website = trim($data['website']);

    // Update the university
    $status = updateUniversity($id, $name, $location, $major, $website);

    if ($status) {
        echo json_encode(['success' => true, 'message' => 'University updated successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error occurred while updating']);
    }
    exit();
}

// Handle invalid request methods
echo json_encode(['success' => false, 'error' => 'Invalid request method']);
exit();
