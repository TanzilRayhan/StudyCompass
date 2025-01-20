<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add University</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
                <li><a href="../view/userDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <div class="form">
        <div class="addArticles-container">
            <form method="post" action="../controller/addUni.php" class="addArticles-form" onsubmit="return false;">
                <div class="addArticles-group">
                    <label for="name">University Name</label>
                    <input type="text" id="name" name="name">
                </div>

                <div class="addArticles-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location">
                </div>

                <div class="addArticles-group">
                    <label for="major">Major</label>
                    <input type="text" id="major" name="major">
                </div>

                <div class="addArticles-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="website" placeholder="https://example.com">
                </div>

                <div class="addArticles-buttons" style="display: flex; gap: 10px; justify-content: center;">
                    <button type="button" class="addArticles-btn" onclick="submitForm()">Submit</button>
                    <button type="reset" class="addArticles-btn reset">Reset</button>
                    <button type="button" class="addArticles-btn" onclick="window.location.href='universitiesAdmin.php'">
                        Back
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            let name = document.getElementById('name').value.trim();
            let location = document.getElementById('location').value.trim();
            let major = document.getElementById('major').value.trim();
            let website = document.getElementById('website').value.trim();

            if (name === '' || location === '' || major === '' || website === '') {
                alert("All fields are required!");
                return false;
            }

            return true;
        }

        function submitForm() {
            if (!validateForm()) return;

            let name = document.getElementById('name').value.trim();
            let location = document.getElementById('location').value.trim();
            let major = document.getElementById('major').value.trim();
            let website = document.getElementById('website').value.trim();

            let data = JSON.stringify({ name, location, major, website });

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/addUni.php', true);
            this.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
            this.send('data=' + data);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    if (response.success) {
                        alert("University added successfully!");
                        document.getElementById('name').value = '';
                        document.getElementById('location').value = '';
                        document.getElementById('major').value = '';
                        document.getElementById('website').value = '';
                    } else {
                        alert("Failed to add university: " + response.error);
                    }
                }
            };
        }
    </script>
</body>

</html>
