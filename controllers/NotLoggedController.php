<?php

class NotLoggedController
{
    private $db;
    private $commentModel;
    private $logModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->commentModel = new Comment($db);
        $this->logModel = new Log($db);
    }

    public function addComment($postId, $content)
    {
        $this->commentModel->addComment($postId, 0, $content);
        $this->logModel->addLog(0, 'Added new comment.');

        header('Location: /post.php?id=' . $postId);
    }
}