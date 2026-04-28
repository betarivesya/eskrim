<?php
class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register($name, $email, $password) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $this->conn->prepare(
        "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
    );

    return $stmt->execute([$name, $email, $passwordHash]);
}

    public function login($email, $password) {
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ✅ pakai password_verify
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        return true;
    }

    return false;
}
}