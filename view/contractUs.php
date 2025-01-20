<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Us</title>
    <link rel="stylesheet" href="../assets/styles.css">

</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="../view/universitiesUser.php">Universities</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/showEvents.php">Events</a></li>
            </ul>
        </div>
    </nav>
    <h1 style="text-align: center;">Contact US</h1>
    <fieldset style="width: 50%; margin: auto;">
        <form action="../controller/checkContractUs.php" method="post" onsubmit="return check()">
            Name:<input type="text" name="username" value="" id="username"></br></br>
            Email:<input type="text" name="email" value="" id="email"></br></br>
            <fieldset>
                <legend>Message</legend>
                <textarea name="message" id="message" style="width: 100%; height:100px"></textarea>
            </fieldset>
            <input type="submit" name="submit" value="Submit" id="submit" />
        </form>
    </fieldset>
    <script>
        function check() {
            let name = document.getElementById('username').value;
            let email = document.getElementById('email').value;
            let message = document.getElementById('message').value;
            let button = document.getElementById('submit').value;
            let emailpattern = /\S+@\S+\.\S+/;
            if (name.trim() == "" || email.trim() == "" || message.trim() == "" || !emailpattern.test(email)) {
                alert("Insert all the fields Properly")
                return false;
            } else return true;

        }
    </script>
</body>

</html>