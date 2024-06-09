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

    // Rejestracja nowego użytkownika
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $email, $hashedPassword]);
    }

    // Logowanie użytkownika
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Użytkownik został znaleziony i hasło jest poprawne
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->email = $user['email'];
            return true;
        } else {
            // Użytkownik nie istnieje lub hasło jest niepoprawne
            return false;
        }
    }

    // Pobranie ID zalogowanego użytkownika
    public function getId() {
        return $this->id;
    }

    // Pobranie nazwy użytkownika zalogowanego użytkownika
    public function getUsername() {
        return $this->username;
    }

    // Sprawdzenie, czy użytkownik jest zalogowany
    public function isLoggedIn() {
        return isset($this->id);
    }

    // Wylogowanie użytkownika
    public function logout() {
        session_destroy();
        unset($this->id);
        unset($this->username);
        unset($this->password);
        unset($this->email);
    }

    // Sprawdzenie, czy użytkownik o podanym adresie email już istnieje
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    // Sprawdzenie, czy użytkownik o podanej nazwie użytkownika już istnieje
    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}