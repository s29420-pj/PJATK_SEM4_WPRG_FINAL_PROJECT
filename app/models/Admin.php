<?php

namespace models;

require_once __DIR__ . '/../app.php';

use Database;
use Exception;

class Admin extends User {
    public function removeUser($id) {
        $role = $this->getUserRole($id);
        if ($role !== 'ADMIN') {
            throw new Exception('You do not have permission to remove a user.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM wprg_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function editUserRole($newRole, $id) {
        $role = $this->getUserRole($id);
        if ($role !== 'ADMIN') {
            throw new Exception('You do not have permission to promote a user.');
        }

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE wprg_users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $newRole,$id);
        $stmt->execute();
        $stmt->close();
    }
}