<?php
require_once('../model/scholarshipModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) 
{
    $query = trim($_POST['query']);
    $scholarships = searchScholarships($query); 
    echo json_encode($scholarships);
}
?>
