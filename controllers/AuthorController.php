<?php

class AuthorController {
    private $db;
    private $postModel;
    private $commentModel;
    private $logModel;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->postModel = new Post($db);
        $this->commentModel = new Comment($db);
        $this->logModel = new Log($db);
        $this->userModel = new User($db);
    }

    public function addPost() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image'];

        $this->postModel->addPost($title, $content, $image);
        $this->logModel->addLog($this->userModel->getId(), 'Added new post.');

        include_once 'views/author/add_post.php';
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
            include_once 'views/author/edit_post.php';
        }
    }

    public function deletePost($postId) {
        $this->postModel->deletePost($postId);
        $this->logModel->addLog($this->userModel->getId(), 'Deleted post.');

        header('Location: /author/manage_posts.php');
    }

    public function resetPassword() {
        $this->userModel->resetPassword($this->userModel->getId());
        $this->logModel->addLog($this->userModel->getId(), 'Reset password.');

        header('Location: /auth/reset_password.php');
    }

    public function addComment($postId, $content) {
        $this->commentModel->addComment($postId, $this->userModel->getId(), $content);
        $this->logModel->addLog($this->userModel->getId(), 'Added new comment.');

        header('Location: /post.php?id=' . $postId);
    }

    public function editComment($commentId, $content) {
        $this->commentModel->editComment($commentId, $content);
        $this->logModel->addLog($this->userModel->getId(), 'Edited comment.');

        $postId = $this->commentModel->getPostIdByCommentId($commentId);

        header('Location: /post.php?id=' . $postId);
    }
}