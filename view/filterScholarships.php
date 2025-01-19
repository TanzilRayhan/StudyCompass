<?php
require_once('../model/scholarshipModel.php');
$con = getConnection();

$names = getDistinctValues($con, 'name');
$universities = getDistinctValues($con, 'university_name');
$countries = getDistinctValues($con, 'country');
$budgets = getDistinctValues($con, 'budget');
$courses = getDistinctValues($con, 'course');
$deadlines = getDistinctValues($con, 'deadline');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filter Scholarships</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin-top: 1rem;
            color: #023e8a;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2rem;
        }
        label {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #023e8a;
        }
        select {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 300px; 
            font-size: 1rem;
        }
        button {
            padding: 0.8rem 1.2rem;
            background-color: #023e8a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #27374d;
        }
        .back-button {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .back-button button {
            padding: 0.8rem 1.2rem; 
            background-color: #023e8a; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button button:hover {
            background-color: #27374d; 
        }
        .table-container {
            margin-top: 2rem;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .form-container {
            display: block; /* Initially, show the form */
        }
        .results-container {
            display: none; /* Initially hide the results container */
        }
    </style>
    <script>
        // Simple form validation
        function validateForm() {
            const name = document.getElementById("name").value;
            const university = document.getElementById("university").value;
            const country = document.getElementById("country").value;
            const budget = document.getElementById("budget").value;
            const course = document.getElementById("course").value;
            const deadline = document.getElementById("deadline").value;

            if (!name && !university && !country && !budget && !course && !deadline) {
                alert("Please select at least one filter to search for scholarships.");
                return false;
            }
            return true; 
        }

        function submitForm(event) {
            event.preventDefault();

            if (!validateForm()) {
                return; 
            }

            const formData = {
                name: document.getElementById("name").value,
                university_name: document.getElementById("university").value,
                country: document.getElementById("country").value,
                budget: document.getElementById("budget").value,
                course: document.getElementById("course").value,
                deadline: document.getElementById("deadline").value,
            };

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controller/filterScholarshipCheck.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        displayFilteredScholarships(response.data);
                    } else {
                        alert("No scholarships found for the selected filters.");
                    }
                } else {
                    alert("Error: " + xhr.status);
                }
            };

            xhr.send(JSON.stringify(formData)); 
        }

        function displayFilteredScholarships(scholarships) {
            let tableContent = `
                <table>
                    <tr style="background-color: #023e8a; color: white;">
                        <th>Name</th>
                        <th>University</th>
                        <th>Country</th>
                        <th>Budget</th>
                        <th>Course</th>
                        <th>Deadline</th>
                    </tr>
            `;

            scholarships.forEach(scholarship => {
                tableContent += `
                    <tr>
                        <td>${scholarship.name}</td>
                        <td>${scholarship.university_name}</td>
                        <td>${scholarship.country}</td>
                        <td>${scholarship.budget}</td>
                        <td>${scholarship.course}</td>
                        <td>${scholarship.deadline}</td>
                    </tr>
                `;
            });

            tableContent += "</table>";
            document.getElementById("scholarshipResults").innerHTML = tableContent;

            // Hide the form, upper back button, and show the results and lower back button
            document.getElementById("filterForm").style.display = "none";
            document.getElementById("formContainer").style.display = "none"; // Optional to hide the entire form container
            document.getElementById("scholarshipResults").style.display = "block";
            document.getElementById("backButton").style.display = "block"; // Show the results' back button
            document.querySelector('.back-button button').style.display = 'none'; // Hide the upper back button
        }
    </script>
</head>
<body>
    <h1>Filter Scholarships</h1>

    <div id="formContainer" class="form-container">
        <form id="filterForm" onsubmit="submitForm(event)">
            <label for="name">Scholarship Name:</label>
            <select id="name" name="name">
                <option value="">-- Select Name --</option>
                <?php foreach ($names as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="university">University Name:</label>
            <select id="university" name="university_name">
                <option value="">-- Select University --</option>
                <?php foreach ($universities as $university): ?>
                    <option value="<?= htmlspecialchars($university) ?>"><?= htmlspecialchars($university) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="country">Country:</label>
            <select id="country" name="country">
                <option value="">-- Select Country --</option>
                <?php foreach ($countries as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="budget">Budget:</label>
            <select id="budget" name="budget">
                <option value="">-- Select Budget --</option>
                <?php foreach ($budgets as $budget): ?>
                    <option value="<?= htmlspecialchars($budget) ?>"><?= htmlspecialchars($budget) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="course">Course:</label>
            <select id="course" name="course">
                <option value="">-- Select Course --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= htmlspecialchars($course) ?>"><?= htmlspecialchars($course) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="deadline">Deadline:</label>
            <select id="deadline" name="deadline">
                <option value="">-- Select Deadline --</option>
                <?php foreach ($deadlines as $deadline): ?>
                    <option value="<?= htmlspecialchars($deadline) ?>"><?= htmlspecialchars($deadline) ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>
    <div class="back-button">
        <button onclick="location.href='../view/userScholarships.php'">Back</button>
    </div>

    <!-- Display filtered scholarships here -->
    <div id="scholarshipResults" style="display: none;"></div>

    <!-- Back Button -->
    <div id="backButton" class="back-button" style="display: none;">
        <button onclick="window.location.href='filterScholarships.php'">Back</button>
    </div>
</body>
</html>
