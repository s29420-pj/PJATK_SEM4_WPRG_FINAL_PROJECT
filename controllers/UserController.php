<?php

class UserController {
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

    public function resetPassword() {
        $this->userModel->resetPassword();
        $this->logModel->addLog($this->userModel->getId(), 'Reset password.');

        header('Location: /auth/reset_password.php');
    }
}