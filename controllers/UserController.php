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
    public function loginUser($user_name, $user_password) {
        // Validate input
        if (empty($user_name) || empty($user_password)) {
            return json_encode(array("success" => false, "message" => "Username and password are required."));
        }
    
        // Retrieve user by email
        $user = $this->model->getUserByEmail($user_name);
    
        // Check if user exists
        if (!$user) {
            return json_encode(array("success" => false, "message" => "User not found."));
        }

        $user_type = $this->model->getUserTypeByEmail($user_name);
        if ($user_type === 'None') {
            return json_encode(array("success" => false, "message" => "You are not approved. Please contact admin."));
        }
    
        // Verify password
        if (password_verify($user_password, $user['user_password'])) {
            $user_id = $user['user_id'];
            $user_type = $user['user_type'];
            return json_encode(array(
                "success" => true,
                "message" => "Logged in successfully with ID: $user_id, name: $user_name, type: $user_type"
            ));
        } elseif ($user_password === $user['user_password']) {
            // Password is plaintext and matches
            return json_encode(array(
                "success" => true,
                "message" => "Logged in successfully with ID: $user_id, name: $user_name, type: $user_type"
            ));
        } else {
            return json_encode(array("success" => false, "message" => "Incorrect password."));
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
