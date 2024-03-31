<?php

require_once 'models/UserModel.php';
require_once 'config/config.php'; 

class UserController {
    private $model;

    public function __construct() {
        global $db; // Access the global database connection
        $this->model = new UserModel($db); // Pass the database connection to the UserModel constructor
    }

    public function createUser($user_name, $user_password) {
        // Validate input
        if (empty($user_name) || empty($user_password)) {
            return json_encode(array("success" => false, "message" => "Username and password are required."));
        }

        // Check if user already exists
        $existingUser = $this->model->getUserByEmail($user_name);
        if ($existingUser) {
            return json_encode(array("success" => false, "message" => "Username already exists."));
        }

        // Check password strength
        if (!$this->isStrongPassword($user_password)) {
            return json_encode(array("success" => false, "message" => "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character."));
        }

        // Create user
        $result = $this->model->createUser($user_name, $user_password);
        
        if ($result) {
            return json_encode(array("success" => true, "message" => "User created successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to create user."));
        }
    }

    private function isStrongPassword($user_password) {
        // Implement your strong password checking logic here
        // For example: at least 8 characters, contain at least one uppercase letter, one lowercase letter, one number, and one special character
        if (strlen($user_password) < 8 ||
            !preg_match("/[A-Z]/", $user_password) ||
            !preg_match("/[a-z]/", $user_password) ||
            !preg_match("/[0-9]/", $user_password) ||
            !preg_match("/[\W_]/", $user_password)) {
            return false;
        }
        return true;
    }
}
?>
