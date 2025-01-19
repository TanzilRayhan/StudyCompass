<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Scholarship</title>
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
            margin: 1rem auto;
            padding: 2rem;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        table tr td {
            padding: 0.8rem;
            vertical-align: top;
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
        }

        button {
            background-color: #023e8a;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
        }

        button:hover {
            background-color: #27374d;
        }

        .back-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .back-button button {
            background-color: #023e8a;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #27374d;
        }
    </style>

    <script>
        function validateForm() {
            const name = document.querySelector('input[name="name"]').value;
            const universityName = document.querySelector('input[name="university_name"]').value;
            const scholarshipUrl = document.querySelector('input[name="scholarship_url"]').value;
            const country = document.querySelector('input[name="country"]').value;
            const budget = document.querySelector('input[name="budget"]').value;
            const course = document.querySelector('input[name="course"]').value;
            const deadline = document.querySelector('input[name="deadline"]').value;
            const eligibility = document.querySelector('textarea[name="eligibility"]').value;
            const description = document.querySelector('textarea[name="description"]').value;

            if (!name || !universityName || !scholarshipUrl || !country || !budget || !course || !deadline || !eligibility || !description) {
                alert("All fields are required.");
                return false;
            }

            if (isNaN(budget) || budget <= 0) {
                alert("Please enter a valid budget.");
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
                name: document.querySelector('input[name="name"]').value,
                university_name: document.querySelector('input[name="university_name"]').value,
                scholarship_url: document.querySelector('input[name="scholarship_url"]').value,
                country: document.querySelector('input[name="country"]').value,
                budget: document.querySelector('input[name="budget"]').value,
                course: document.querySelector('input[name="course"]').value,
                deadline: document.querySelector('input[name="deadline"]').value,
                eligibility: document.querySelector('textarea[name="eligibility"]').value,
                description: document.querySelector('textarea[name="description"]').value
            };

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controller/addScholarshipCheck.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onload = function() {
                if (xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Scholarship added successfully!");
                        window.location.href = "../view/adminScholarships.php"; 
                    } else {
                        alert("Failed to add scholarship. Please try again.");
                    }
                } else {
                    alert("Error: " + xhr.status);
                }
            };

            xhr.send(JSON.stringify(formData)); // Send form data as JSON
        }
    </script>
</head>
<body>
    <h1>Add Scholarship</h1>
    <form id="addScholarshipForm" onsubmit="submitForm(event)">
        <table>
            <tr>
                <td>Scholarship Name:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>University Name:</td>
                <td><input type="text" name="university_name"></td>
            </tr>
            <tr>
                <td>Website:</td>
                <td><input type="url" name="scholarship_url"></td>
            </tr>
            <tr>
                <td>Country:</td>
                <td><input type="text" name="country"></td>
            </tr>
            <tr>
                <td>Budget:</td>
                <td><input type="number" name="budget" step="0.01"></td>
            </tr>
            <tr>
                <td>Course:</td>
                <td><input type="text" name="course"></td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline"></td>
            </tr>
            <tr>
                <td>Eligibility:</td>
                <td><textarea name="eligibility" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="description" rows="3"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">Add Scholarship</button>
                </td>
            </tr>
        </table>
    </form>

    <div class="back-button">
        <button onclick="window.location.href='../view/adminScholarships.php'">Back</button>
    </div>
</body>
</html>
