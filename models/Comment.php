<?php

class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Dodawanie nowego komentarza
    public function addComment($postId, $userId, $content) {
        $sql = "INSERT INTO comments (post_id, user_id, content, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId, $userId, $content]);
    }

    // Pobranie wszystkich komentarzy dla danego posta
    public function getCommentsByPostId($postId) {
        $sql = "SELECT * FROM comments WHERE post_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    // Edycja istniejącego komentarza
    public function editComment($commentId, $content) {
        $sql = "UPDATE comments SET content = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$content, $commentId]);
    }

    // Usunięcie istniejącego komentarza
    public function deleteComment($commentId) {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$commentId]);
    }
}
