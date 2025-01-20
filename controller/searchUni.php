<?php
session_start();
require_once('../model/uniModel.php');

// Initialize variables
$searchResults = [];
$error = '';
$searchQuery = isset($_POST['name']) ? trim($_POST['name']) : '';

if (isset($_POST['search'])) {
    if (!empty($searchQuery)) {
        $con = getConnection();

        $searchQuery = mysqli_real_escape_string($con, $searchQuery);

        $sql = "SELECT * FROM universities WHERE name LIKE '%$searchQuery%'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
            if (empty($searchResults)) {
                $error = "University not found.";
            }
        } else {
            $error = "Error fetching data. Please try again.";
        }

        mysqli_close($con);
    } else {
        $error = "Please enter a university name to search.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Universities</title>
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

    <div class="container">
        <h1 style="text-align: center;">Search Universities</h1>

        <!-- Search Form -->
        <div class="form-container">
            <form method="POST" action="../controller/searchUni.php" class="search-form">
                <input type="text" name="name" placeholder="Enter university name" value="<?= htmlspecialchars($searchQuery ?? '') ?>">
                <button type="submit" name="search" id="btnSearch">Search</button>
            </form>
        </div>

        <?php if (!empty($error)) : ?>
            <p style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- Results Table -->
        <table class="user-management">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Major</th>
                    <th>Website</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($searchResults)) : ?>
                    <?php foreach ($searchResults as $university) : ?>
                        <tr>
                            <td><?= htmlspecialchars($university['id']); ?></td>
                            <td><?= htmlspecialchars($university['name']); ?></td>
                            <td><?= htmlspecialchars($university['location']); ?></td>
                            <td><?= htmlspecialchars($university['major']); ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($university['website']); ?>" target="_blank">Visit Website</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php if (isset($_POST['search'])) : ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No results found for "<?= htmlspecialchars($searchQuery) ?>"</td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>