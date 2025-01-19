<?php
require_once('../model/uniModel.php');
require_once('../model/scholarshipModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $university_id = $_POST['university_id'] ?? null;
    $scholarship_id = $_POST['scholarship_id'] ?? null;

    if (!$university_id || !$scholarship_id) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
        exit;
    }

    $university = getUniversity($university_id);
    $scholarship = getScholarship($scholarship_id);

    if ($university && $scholarship) {
        $remaining_budget = $university['budget_range'] - $scholarship['budget'];

        echo json_encode([
            'status' => 'success',
            'university' => htmlspecialchars($university['name']),
            'scholarship' => htmlspecialchars($scholarship['name']),
            'original_budget' => htmlspecialchars($university['budget_range']),
            'scholarship_amount' => htmlspecialchars($scholarship['budget']),
            'remaining_budget' => htmlspecialchars($remaining_budget),
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid university or scholarship selection.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
