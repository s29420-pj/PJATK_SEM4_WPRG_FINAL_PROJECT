<?php

namespace models;

require_once __DIR__ . '/../app.php';

use Database;
use Exception;
use models\User;

class Post {
    private $id;
    private $title;
    private $content;
    private $image;
    private $date;
    private $authorId;

    public function createPost($title, $content, $image = NULL, $userId, $date) {
        $user = new User();
        $userRole = $user->getUserRole($userId);
        if ($userRole == 'USER' || $userId == NULL) {
            throw new Exception('You do not have permission to create a post.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO wprg_posts (title, content, image, date, author_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $image, $date, $userId);
        $stmt->execute();
        $stmt->close();
    }

    public function editPost($id, $title, $content, $image = NULL, $userId) {
        $user = new User();
        $userRole = $user->getUserRole($userId);
        if ($userRole == 'USER' || $userId == NULL) {
            throw new Exception('You do not have permission to edit a post.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE wprg_posts SET title = ?, content = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $content, $image, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function removePost($id, $userId) {
        $user = new User();
        $userRole = $user->getUserRole($userId);
        if ($userRole == 'USER' || $userId == NULL) {
            throw new Exception('You do not have permission to remove a post.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM wprg_posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getPost($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getPosts() {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_posts");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function sortPostsByDate() {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_posts ORDER BY date DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}