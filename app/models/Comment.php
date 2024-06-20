<?php

namespace models;

require_once __DIR__ . '/../app.php';

use Database;

class Comment {
    private $id;
    private $content;
    private $date;
    private $authorId;

    public function createComment($content, $postId, $authorUsername = 'Guest', $date) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO wprg_comments (content, post_id, author_username, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $content, $postId, $authorUsername, $date);
        $stmt->execute();
        $stmt->close();
    }
}