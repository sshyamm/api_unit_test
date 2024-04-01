<?php

require_once 'models/UserModel.php';
require_once 'config/config.php'; 

class UserController {
    private $model;

    public function __construct() {
        global $db;
        $this->model = new UserModel($db); 
    }

    public function createUser($user_name, $user_password) {
        if (empty($user_name) || empty($user_password)) {
            return json_encode(array("success" => false, "message" => "Username and password are required."));
        }

        $existingUser = $this->model->getUserByEmail($user_name);
        if ($existingUser) {
            return json_encode(array("success" => false, "message" => "Username already exists."));
        }

        if (!$this->isStrongPassword($user_password)) {
            return json_encode(array("success" => false, "message" => "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character."));
        }

        $result = $this->model->createUser($user_name, $user_password);
        
        if ($result) {
            return json_encode(array("success" => true, "message" => "User created successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to create user."));
        }
    }
    public function loginUser($user_name, $user_password) {
        if (empty($user_name) || empty($user_password)) {
            return json_encode(array("success" => false, "message" => "Username and password are required."));
        }
    
        $user = $this->model->getUserByEmail($user_name);
    
        if (!$user) {
            return json_encode(array("success" => false, "message" => "User not found."));
        }
    
        $user_type = $this->model->getUserTypeByEmail($user_name);
        if ($user_type === 'None') {
            return json_encode(array("success" => false, "message" => "You are not approved. Please contact admin."));
        }
    
        if ($this->model->loginUser($user_name, $user_password)) {
            $user_id = $user['user_id'];
            $user_type = $user['user_type'];
            return json_encode(array(
                "success" => true,
                "message" => "Logged in successfully with ID: $user_id, name: $user_name, type: $user_type"
            ));
        } else {
            return json_encode(array("success" => false, "message" => "Incorrect password."));
        }
    }    

    private function isStrongPassword($user_password) {
        if (strlen($user_password) < 8 ||
            !preg_match("/[A-Z]/", $user_password) ||
            !preg_match("/[a-z]/", $user_password) ||
            !preg_match("/[0-9]/", $user_password) ||
            !preg_match("/[\W_]/", $user_password)) {
            return false;
        }
        return true;
    }
    public function getUserProfile($user_id) {
        if (empty($user_id)) {
            return json_encode(array("success" => false, "message" => "User ID is required."));
        }
    
        $user_type = $this->model->getUserTypeById($user_id);
    
        if (!$user_type) {
            return json_encode(array("success" => false, "message" => "User not found."));
        }
    
        switch ($user_type) {
            case 'Student':
                $profile = $this->model->getStudentProfileByUserId($user_id);
                break;
            case 'Teacher':
                $profile = $this->model->getTeacherProfileByUserId($user_id);
                break;
            default:
                return json_encode(array("success" => false, "message" => "Invalid user type."));
        }
    
        if (!$profile) {
            return json_encode(array("success" => false, "message" => "Profile not found."));
        }
    
        return json_encode(array("success" => true, "profile" => $profile));
    }
    public function editStudent($user_parent_id, $user_name, $phone_num, $email, $age_group_parent_id, $course_parent_id, $level_parent_id, $emergency_contact, $blood_group, $address, $pincode, $city_parent_id, $state_parent_id) {
        if (empty($user_parent_id)) {
            return json_encode(array("success" => false, "message" => "User ID is required."));
        }
    
        $existence = $this->model->checkStudent($user_parent_id);
        if (!$existence) {
            return json_encode(array("success" => false, "message" => "Student not found."));
        }

        $duplicate = $this->model->checkDup($user_name, $user_parent_id);
        if ($duplicate) {
            return json_encode(array("success" => false, "message" => "Student username already exists."));
        }

        $result = $this->model->editStudent($user_parent_id, $user_name, $phone_num, $email, $age_group_parent_id, $course_parent_id, $level_parent_id, $emergency_contact, $blood_group, $address, $pincode, $city_parent_id, $state_parent_id);
    
        if ($result) {
            return json_encode(array("success" => true, "message" => "Student details updated successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to update student details."));
        }
    }
}
?>
