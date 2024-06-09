<?php

class AdminController {
    private $db;
    private $postModel;
    private $logModel;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->postModel = new Post($db);
        $this->logModel = new Log($db);
        $this->userModel = new User($db);
    }

    public function addPost() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image'];

        $this->postModel->addPost($title, $content, $image);
        $this->logModel->addLog($this->userModel->getId(), 'Added new post.');

        // Wczytaj widok formularza dodawania posta
        include_once 'views/admin/add_post.php';
    }

    public function editPost($postId) {
        $post = $this->postModel->getPostById($postId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image'];

            $this->postModel->editPost($postId, $title, $content, $image);
            $this->logModel->addLog($this->userModel->getId(), 'Edited post.');

            header('Location: /admin/manage_posts.php');
        } else {
            include_once 'views/admin/edit_post.php';
        }
    }

    public function deletePost($postId) {
        $this->postModel->deletePost($postId);
        $this->logModel->addLog($this->userModel->getId(), 'Deleted post.');

        header('Location: /admin/manage_posts.php');
    }

    public function viewLogs() {
        $logs = $this->logModel->getAllLogs();
        include_once 'views/admin/view_logs.php';
    }
}