
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit University</title>
</head>
<body>
    <h1>Edit University</h1>
    <form method="post" action="../view/updateUni.php">
        <input type="hidden" name="id" value="<?= $university['id'] ?>">

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= $university['name'] ?>" required>

        <label for="location">Location</label>
        <input type="text" id="location" name="location" value="<?= $university['location'] ?>" required>

        <label for="major">Major</label>
        <input type="text" id="major" name="major" value="<?= $university['major'] ?>" required>

        <label for="budget">Budget</label>
        <input type="text" id="budget" name="budget" value="<?= $university['budget_range'] ?>" required>

        <label for="website">Website</label>
        <input type="text" id="website" name="website" value="<?= $university['website'] ?>" required>

        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
