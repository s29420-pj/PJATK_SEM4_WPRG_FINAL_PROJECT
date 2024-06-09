<?php

class Log {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addLog($userId, $action) {
        $sql = "INSERT INTO logs (user_id, action, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $action]);
    }

    public function getAllLogs() {
        $sql = "SELECT * FROM logs ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
