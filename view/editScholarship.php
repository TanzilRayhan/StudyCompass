<?php

require_once('../model/scholarshipModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $scholarship = getScholarship($id); 
} else {
    header("Location: manageScholarship.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Scholarship</title>
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
            background-color: #fff;
            margin: 2rem auto;
            padding: 2rem;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            color: #023e8a;
        }

        input[type="text"],
        input[type="url"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 1rem;
        }

        input[type="submit"] {
            background-color: #023e8a;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #27374d;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            background-color: #023e8a;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button a:hover {
            background-color: #27374d;
        }

        textarea {
            resize: vertical;
        }
    </style>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var university_name = document.getElementById("university_name").value;
            var scholarship_url = document.getElementById("scholarship_url").value;
            var country = document.getElementById("country").value;
            var budget = document.getElementById("budget").value;
            var course = document.getElementById("course").value;
            var deadline = document.getElementById("deadline").value;
            var eligibility = document.getElementById("eligibility").value;
            var description = document.getElementById("description").value;

            if (name == "" || university_name == "" || scholarship_url == "" || country == "" || budget == "" || course == "" || deadline == "" || eligibility == "" || description == "") {
                alert("All fields must be filled out!");
                return false;
            }
            if (isNaN(budget) || budget <= 0) {
                alert("Please enter a valid positive number for the budget.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Edit Scholarship</h1>
    <form action="../controller/editScholarshipCheck.php" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?php echo $scholarship['id']; ?>">

        <label for="name">Scholarship Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $scholarship['name']; ?>"><br>

        <label for="university_name">University Name:</label>
        <input type="text" id="university_name" name="university_name" value="<?php echo $scholarship['university_name']; ?>"><br>

        <label for="scholarship_url">Scholarship URL:</label>
        <input type="url" id="scholarship_url" name="scholarship_url" value="<?php echo $scholarship['scholarship_url']; ?>"><br>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" value="<?php echo $scholarship['country']; ?>"><br>

        <label for="budget">Budget:</label>
        <input type="number" id="budget" name="budget" value="<?php echo $scholarship['budget']; ?>"><br>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" value="<?php echo $scholarship['course']; ?>"><br>

        <label for="deadline">Deadline:</label>
        <input type="date" id="deadline" name="deadline" value="<?php echo $scholarship['deadline']; ?>"><br>

        <label for="eligibility">Eligibility:</label>
        <textarea id="eligibility" name="eligibility"><?php echo $scholarship['eligibility']; ?></textarea><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $scholarship['description']; ?></textarea><br>

        <input type="submit" value="Update Scholarship">
    </form>

    <div class="back-button">
        <a href="../view/adminScholarships.php">Back</a>
    </div>
</body>
</html>
