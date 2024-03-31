<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($user_name, $user_password) {
        // Check if user already exists
        $existingUser = $this->getUserByEmail($user_name);
        if ($existingUser) {
            return false; // User already exists
        }

        // Create user in the database forcommon user
        $query = "INSERT INTO users (user_name, user_password) VALUES (:user_name, :user_password)";
        $stmt = $this->db->prepare($query);
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":user_password", $hashed_password);
        return $stmt->execute();
    }

    public function getUserByEmail($user_name) {
        $query = "SELECT * FROM users WHERE user_name = :user_name";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>
