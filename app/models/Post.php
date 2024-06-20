<?php

namespace models;

require_once __DIR__ . '/../app.php';

use Database;
use Exception;

class Post
{
    private $id;
    private $title;
    private $content;
    private $image;
    private $date;
    private $authorId;

    public function createPost($title, $content, $image = NULL, $userId, $date)
    {
        $user = new User();
        $userRole = $user->getUserRole($userId);
        if ($userRole == 'USER' || $userRole == NULL) {
            throw new Exception('You do not have permission to create a post.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO wprg_posts (title, content, image, date, author_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $image, $date, $userId);
        $stmt->execute();
        $stmt->close();
    }

    public function editPost($id, $title, $content, $image = NULL, $userId)
    {
        $user = new User();
        $userRole = $user->getUserRole($userId);
        if ($userRole == 'USER' || $userRole == NULL) {
            throw new Exception('You do not have permission to edit a post.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE wprg_posts SET title = ?, content = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $content, $image, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function removePost($id, $userId)
    {
        $user = new User();
        $userRole = $user->getUserRole($userId);
        if ($userRole == 'USER' || $userRole == NULL) {
            throw new Exception('You do not have permission to remove a post.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM wprg_posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getPost($id)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getAllPosts()
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_posts");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function sortPostsByDate()
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_posts ORDER BY date DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostAuthor($postId)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT wprg_users.username
FROM wprg_posts
INNER JOIN wprg_users ON wprg_posts.wprg_users_id = wprg_users.id
WHERE wprg_posts.id = ?;");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc()['username'];
    }
}