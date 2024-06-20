<?php

namespace models;

require_once __DIR__ . '/../app.php';

use Database;
use Exception;

class Comment
{
    private $id;
    private $content;
    private $date;
    private $authorId;

    public function createComment($content, $date, $userId, $postId)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO wprg_comments (content, date, wprg_users_id, wprg_posts_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $content, $date, $userId, $postId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteComment($id, $adminId)
    {
        $user = new Admin();
        $admin = $user->getUserRole($adminId);
        if ($admin !== 'ADMIN') {
            throw new Exception('You do not have permission to remove a comment.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM wprg_comments WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getComments($postId)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_comments WHERE wprg_posts_id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}