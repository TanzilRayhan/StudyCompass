<?php
require_once('../model/uniModel.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id) {
    echo "Error: University ID is missing!";
    exit();
}

$university = getUniversity($id);

if (!$university) {
    echo "Error: University not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit University</title>
    <link rel="stylesheet" href="../assets/editUni.css">
</head>

<body>
    <div class="container">
        <h1>Edit University</h1>
        <form method="post" id="editUniversityForm">
            <input type="hidden" id="id" name="id" value="<?= htmlspecialchars($university['id']) ?>">

            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($university['name']) ?>">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="<?= htmlspecialchars($university['location']) ?>">

            <label for="major">Major</label>
            <input type="text" id="major" name="major" value="<?= htmlspecialchars($university['major']) ?>">

            <label for="website">Website</label>
            <input type="url" id="website" name="website" value="<?= htmlspecialchars($university['website']) ?>">

            <div class="buttons">
                <button type="button" onclick="updateUniversity()">Submit</button>
                <button type="button" onclick="goBack()">Back</button>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const location = document.getElementById('location').value.trim();
            const major = document.getElementById('major').value.trim();
            const website = document.getElementById('website').value.trim();

            if (name === '' || location === '' || major === '' || website === '') {
                alert("All fields are required!");
                return false;
            }

            const urlPattern = new RegExp('^(https?:\\/\\/)?' +
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}' +
                '|((\\d{1,3}\\.){3}\\d{1,3}))' +
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' +
                '(\\?[;&a-z\\d%_.~+=-]*)?' +
                '(\\#[-a-z\\d_]*)?$', 'i');

            if (!urlPattern.test(website)) {
                alert("Please enter a valid website URL!");
                return false;
            }

            return true;
        }

        function updateUniversity() {
            if (!validateForm()) return;

            const id = document.getElementById('id').value;
            const name = document.getElementById('name').value.trim();
            const location = document.getElementById('location').value.trim();
            const major = document.getElementById('major').value.trim();
            const website = document.getElementById('website').value.trim();

            const data = JSON.stringify({ id, name, location, major, website });

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/updateUni.php', true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send('data=' + data);

            xhttp.onreadystatechange = function () {
                if (this.readyState === 4) {
                    console.log("Response status:", this.status);
                    console.log("Response text:", this.responseText);

                    try {
                        const response = JSON.parse(this.responseText);
                        if (response.success) {
                            alert("University updated successfully!");
                            window.location.href = "../view/universitiesAdmin.php";
                        } else {
                            alert("Failed to update university: " + response.error);
                        }
                    } catch (e) {
                        console.error("Invalid JSON response:", this.responseText);
                        alert("An unexpected error occurred. Please try again.");
                    }
                }
            };
        }

        // Redirect to the previous page
        function goBack() {
            window.location.href = "../view/universitiesAdmin.php";
        }
    </script>
</body>

</html>
