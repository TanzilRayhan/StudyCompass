<?php
session_start();
require_once('../model/messagesModel.php');
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}
$messages = get_messages();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
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
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/adminDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <table style="width: 80%; margin:auto">
        <thead>
            <tr>
                <th>username</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($messages as $message) {
                $i = 1; ?>
                <tr>
                    <td><?= $message['username'] ?></td>
                    <td><?= $message['email'] ?></td>
                    <td><textarea><?= $message['message'] ?></textarea></td>
                    <td>
                        <a href="../controller/deleteContract.php?id=<?= $message['message_id'] ?>">Delete</a>
                        <a href="replyContract.php?id=<?= $message['message_id'] ?>">Reply</a>
                    </td>
                </tr>
            <?php }
            if ($i == 0) { ?>
                <tr>
                    <td colspan="2" , style="text-align: center;color:red;">There is no more notification</td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</body>

</html>