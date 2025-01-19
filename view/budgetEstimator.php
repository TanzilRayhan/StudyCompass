<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}
require_once('../model/uniModel.php');
require_once('../model/scholarshipModel.php');

$universities = getAllUniversities();
$scholarships = getAllScholarships();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Estimator</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label,
        select,
        button {
            font-size: 16px;
        }

        button {
            background-color: #023e8a;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e7f3fe;
            border: 1px solid #023e8a;
            border-radius: 5px;
            display: none;
        }

        #error {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            color: #721c24;
            display: none;
        }

        .back-btn {
            margin-top: 20px;
            text-align: center;
        }

        .back-btn button {
            background-color: #023e8a;
            color: white;
        }

        .back-btn button:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
            </ul>
        </div>
    </nav>
    <h1>Budget Estimator</h1>

    <form id="budgetForm">
        <label for="university">Select University:</label>
        <select id="university" name="university_id" required>
            <option value="">-- Select University --</option>
            <?php foreach ($universities as $university): ?>
                <option value="<?= $university['id'] ?>"><?= htmlspecialchars($university['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="scholarship">Select Scholarship:</label>
        <select id="scholarship" name="scholarship_id">
            <option value="">-- Select Scholarship --</option>
            <?php foreach ($scholarships as $scholarship): ?>
                <option value="<?= $scholarship['id'] ?>"><?= htmlspecialchars($scholarship['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="button" id="estimateBtn">Estimate</button>
    </form>
    <div class="back-btn">
        <a href="userDashboard.php">
            <button type="button">Back</button>
        </a>
    </div>

    <div id="result"></div>
    <div id="error"></div>

    <script>
        document.getElementById('estimateBtn').addEventListener('click', function() {
            const universityId = document.getElementById('university').value;
            const scholarshipId = document.getElementById('scholarship').value;

            if (!universityId || !scholarshipId) {
                alert('Please select both a university and a scholarship.');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/budgetEstimatorCheck.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        document.getElementById('result').style.display = 'block';
                        document.getElementById('error').style.display = 'none';
                        document.getElementById('result').innerHTML = `
                            <h2>Remaining Budget:</h2>
                            <p>University: ${response.university}</p>
                            <p>Scholarship: ${response.scholarship}</p>
                            <p>Original Budget: ${response.original_budget}</p>
                            <p>Scholarship Amount: ${response.scholarship_amount}</p>
                            <p>Remaining Budget: ${response.remaining_budget}</p>
                        `;
                    } else {
                        document.getElementById('error').style.display = 'block';
                        document.getElementById('result').style.display = 'none';
                        document.getElementById('error').innerText = response.message;
                    }
                }
            };
            xhr.send(`university_id=${universityId}&scholarship_id=${scholarshipId}`);
        });
    </script>
</body>

</html>