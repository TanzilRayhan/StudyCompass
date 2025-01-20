<?php
require_once('../model/database.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'fetchLoans') {
    $conn = getConnection();
    $sql = "SELECT * FROM loan_plans";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $loans = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $loans[] = $row;
        }
        echo json_encode(['success' => true, 'loans' => $loans]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch loans.']);
    }
    mysqli_close($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($_POST['data'], true);

    $loanPlanId = isset($data['loanId']) ? intval($data['loanId']) : null;
    $amount = isset($data['amount']) ? floatval($data['amount']) : null;
    $userId = 1; // Assuming a logged-in user with ID 1

    if (!$loanPlanId || !$amount || $amount <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
        exit();
    }

    $conn = getConnection();

    // Validate loan plan
    $sql = "SELECT max_amount FROM loan_plans WHERE id = '$loanPlanId'";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid loan plan ID.']);
        exit();
    }

    $loanPlan = mysqli_fetch_assoc($result);

    // Validate loan amount
    if ($amount > $loanPlan['max_amount']) {
        echo json_encode(['success' => false, 'message' => 'Loan amount exceeds the maximum allowed.']);
        exit();
    }

    // Insert loan application
    $insertSql = "INSERT INTO loan_applications (loan_plan_id, user_id, amount) 
                  VALUES ('$loanPlanId', '$userId', '$amount')";

    if (mysqli_query($conn, $insertSql)) {
        echo json_encode(['success' => true, 'loanId' => $loanPlanId, 'message' => 'Loan application submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to process loan application.']);
    }

    mysqli_close($conn);
}
?>
