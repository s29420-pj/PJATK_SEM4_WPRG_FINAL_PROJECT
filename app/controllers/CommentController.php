<?php

namespace controllers;

class CommentController
{
    private $comment;

    public function createComment($content, $date, $userId, $postId)
    {
        $this->comment->createComment($content, $date, $userId, $postId);
    }

    public function removeComment($id, $adminId)
    {
        $this->comment->deleteComment($id, $adminId);
    }
}