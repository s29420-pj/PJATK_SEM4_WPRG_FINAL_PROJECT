<?php

class User {
    private $db;
    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->email = $user['email'];
            return true;
        } else {
            return false;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function isLoggedIn() {
        return isset($this->id);
    }

    public function logout() {
        session_destroy();
        unset($this->id);
        unset($this->username);
        unset($this->password);
        unset($this->email);
    }

    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    public function resetPassword($username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        $newPassword = $this->generateTempPassword();

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE username = ? AND email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$hashedPassword, $username, $email]);

        return true;
    }

    private function generateTempPassword() {
        return bin2hex(random_bytes(5));
    }

}