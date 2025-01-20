<?php
require_once('../model/loanModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetch') {
    $plans = getAllLoanPlans();
    echo json_encode($plans);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $interest_rate = $_POST['interest_rate'];
        $max_amount = $_POST['max_amount'];
        if (addLoanPlan($name, $interest_rate, $max_amount)) {
            echo json_encode(['success' => true, 'message' => 'Loan plan added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add loan plan.']);
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'];
        if (deleteLoanPlan($id)) {
            echo json_encode(['success' => true, 'message' => 'Loan plan deleted successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete loan plan.']);
        }
    }
}
?>
