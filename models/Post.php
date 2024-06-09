<?php

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addPost($title, $content, $image = null) {
        $sql = "INSERT INTO posts (title, content, image, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $content, $image]);
    }

    public function getAllPosts() {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getPostById($postId) {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetch();
    }

    public function getNextPost($postId) {
        $sql = "SELECT * FROM posts WHERE id > ? ORDER BY id ASC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetch();
    }

    public function getPreviousPost($postId) {
        $sql = "SELECT * FROM posts WHERE id < ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetch();
    }

    public function editPost($postId, $title, $content, $image = null) {
        $sql = "UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$title, $content, $image, $postId]);
    }

    public function deletePost($postId) {
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
    }
}
