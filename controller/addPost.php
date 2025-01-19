<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="container">
        <h1>Add a New Post</h1>
        <form method="post" action="../controller/forumController.php">
            <input type="hidden" name="action" value="addPost">
            <input type="hidden" name="author_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="author_type" value="<?= $_SESSION['user_type'] ?>">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="5" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
