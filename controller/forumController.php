<?php
require_once('../model/forumModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'addPost') {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $author_id = intval($_POST['author_id']);
        $author_type = $_POST['author_type'];

        if (!empty($title) && !empty($content) && !empty($author_id) && !empty($author_type)) {
            if (addPost($title, $content, $author_id, $author_type)) {
                header('Location: ../view/forum.php');
                exit();
            } else {
                echo "Error adding post.";
            }
        }
    }

    if ($action === 'reactToPost') {
        $post_id = intval($_POST['post_id']);
        $user_id = intval($_POST['user_id']);
        $reaction = $_POST['reaction'];

        if (reactToPost($post_id, $user_id, $reaction)) {
            echo "Reaction updated.";
        } else {
            echo "Error updating reaction.";
        }
    }
}
?>
