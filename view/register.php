<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - StudyCompass</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
    function validatePassword(password) {
        const specialChars = /[!@#$%^&*(),.?":{}|<>]/;
        const hasNumber = /\d/;

        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        if (!hasNumber.test(password)) {
            alert("Password must include at least one number.");
            return false;
        }

        if (!specialChars.test(password)) {
            alert("Password must include at least one special character.");
            return false;
        }

        return true;
    }

    function validateAge(age) {
        if (age < 16) {
            alert("You must be at least 16 years old to register.");
            return false;
        }
        return true;
    }

    function validateForm() {
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim();
        var username = document.getElementById("reg-username").value.trim();
        var password = document.getElementById("reg-password").value.trim();
        var age = document.getElementById("age").value.trim();
        var gender = document.getElementById("gender").value.trim();
        var dob = document.getElementById("dob").value.trim();
        var address = document.getElementById("address").value.trim();

        if (name === "") {
            alert("Name is required.");
            document.getElementById("name").focus();
            return false;
        }

        if (email === "") {
            alert("Email is required.");
            document.getElementById("email").focus();
            return false;
        }

        if (username === "") {
            alert("Username is required.");
            document.getElementById("reg-username").focus();
            return false;
        }

        if (password === "") {
            alert("Password is required.");
            document.getElementById("reg-password").focus();
            return false;
        }

        if (!validatePassword(password)) {
            document.getElementById("reg-password").focus();
            return false;
        }

        if (age === "") {
            alert("Age is required.");
            document.getElementById("age").focus();
            return false;
        }

        if(!validateAge(age)){
            document.getElementById("age").focus();
            return false;
        }

        if (gender === "") {
            alert("Gender is required.");
            document.getElementById("gender").focus();
            return false;  
        }

        if (dob === "") {
            alert("Date of Birth is required.");
            document.getElementById("dob").focus();
            return false;
        }

        if (address === "") {
            alert("Address is required.");
            document.getElementById("address").focus();
            return false;
        }

        return true;
    }
</script>

</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
            </ul>
        </div>
    </nav>
    <div class="form">
        <div class="form-container register-container">
            <h2>Register</h2>
            <hr>
            <form method="post" action="../controller/registerCheck.php" onsubmit="return validateForm()">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="reg-username">Username</label>
                        <input type="text" name="username" id="reg-username">
                    </div>
                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input type="password" name="password" id="reg-password">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <option name="gender" value="">Select</option>
                            <option name="gender" value="male">Male</option>
                            <option name="gender" value="female">Female</option>
                            <option name="gender" value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address">
                    </div>
                </div>

                <div class="form-group">
                    <button name="submit" type="submit">Register</button>
                </div>
            </form>
            <div class="switch">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>