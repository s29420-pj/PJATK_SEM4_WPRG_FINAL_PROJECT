<?php

namespace models;

require_once __DIR__ . '/../app.php';

use Database;

class User {
    private $id;
    private $username;
    private $password;
    private $role;

    public function createUser($username, $password, $role = 'USER') {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO wprg_users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        $stmt->execute();
        $stmt->close();
    }

    public function getUser($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getUserRole($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT role FROM wprg_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc()['role'];
    }

    public function authUser($username, $password) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM wprg_users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function resetPassword($id, $newPassword) {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE wprg_users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $newPassword, $id);
        $stmt->execute();
        $stmt->close();
    }
}