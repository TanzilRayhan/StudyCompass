<?php
require_once('../model/forumModel.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetchPosts') {
    $posts = getAllPosts();
    echo json_encode($posts);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] === 'createPost') {
        $title = trim($data['title']);
        $content = trim($data['content']);
        $author = trim($data['username']); 

        if ($title && $content) {
            $result = createPost($title, $content, $author);
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to create post.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'All fields are required.']);
        }
    }
    exit();
}
?>
