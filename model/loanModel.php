<?php
require_once('../model/database.php');

function getAllLoanPlans() {
    $con = getConnection();
    $sql = "SELECT * FROM loan_plans";
    $result = mysqli_query($con, $sql);

    $plans = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $plans[] = $row;
        }
    }
    return $plans;
}

function addLoanPlan($name, $interest_rate, $max_amount) {
    $con = getConnection();
    $sql = "INSERT INTO loan_plans (name, interest_rate, max_amount) 
            VALUES ('$name', '$interest_rate', '$max_amount')";
    return mysqli_query($con, $sql);
}


function updateLoanPlan($id, $name, $interest_rate, $max_amount) {
    $con = getConnection();
    $sql = "UPDATE loan_plans 
            SET name='$name', interest_rate='$interest_rate', max_amount='$max_amount'
            WHERE id='$id'";
    return mysqli_query($con, $sql);
}

function deleteLoanPlan($id) {
    $con = getConnection();
    $sql = "DELETE FROM loan_plans WHERE id='$id'";
    return mysqli_query($con, $sql);
}
?>
