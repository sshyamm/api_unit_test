<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($user_name, $user_password) {
        $existingUser = $this->getUserByEmail($user_name);
        if ($existingUser) {
            return false; 
        }

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

    public function getUserTypeByEmail($user_name) {
        $query = "SELECT user_type FROM users WHERE user_name = :user_name";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function loginUser($user_name, $user_password) {
        $user = $this->getUserByEmail($user_name);
    
        if (!$user) {
            return false; 
        }
    
        if (password_verify($user_password, $user['user_password'])) {
            return true; 
        } 
        elseif ($user_password === $user['user_password']) {
            return true;
        } else {
            return false; 
        }
    }
    
    
    public function getUserProfileById($user_id) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserTypeById($user_id) {
        $query = "SELECT user_type FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    public function getStudentProfileByUserId($user_id) {
        $query = "SELECT * FROM students WHERE user_parent_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTeacherProfileByUserId($user_id) {
        $query = "SELECT * FROM teachers WHERE user_parent_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function checkDup($user_name, $user_parent_id) {
        $query = "SELECT COUNT(*) FROM users WHERE user_name = :user_name AND user_id != :user_parent_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":user_parent_id", $user_parent_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public function checkStudent($user_parent_id) {
        $query = "SELECT COUNT(*) FROM students WHERE user_parent_id = :user_parent_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_parent_id", $user_parent_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function checkTeacher($user_parent_id) {
        $query = "SELECT COUNT(*) FROM teachers WHERE user_parent_id = :user_parent_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_parent_id", $user_parent_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public function editStudent($user_parent_id, $user_name, $phone_num, $email, $age_group_parent_id, $course_parent_id, $level_parent_id, $emergency_contact, $blood_group, $address, $pincode, $city_parent_id, $state_parent_id) {
        $query = "UPDATE students s
                  LEFT JOIN users u ON s.user_parent_id = u.user_id
                  SET u.user_name = :user_name, 
                      s.phone_num = :phone_num, 
                      s.email = :email, 
                      s.age_group_parent_id = :age_group_parent_id, 
                      s.course_parent_id = :course_parent_id, 
                      s.level_parent_id = :level_parent_id, 
                      s.emergency_contact = :emergency_contact, 
                      s.blood_group = :blood_group, 
                      s.address = :address, 
                      s.pincode = :pincode, 
                      s.city_parent_id = :city_parent_id, 
                      s.state_parent_id = :state_parent_id
                  WHERE s.user_parent_id = :user_parent_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":user_parent_id", $user_parent_id);
        $stmt->bindParam(":phone_num", $phone_num);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":age_group_parent_id", $age_group_parent_id);
        $stmt->bindParam(":course_parent_id", $course_parent_id);
        $stmt->bindParam(":level_parent_id", $level_parent_id);
        $stmt->bindParam(":emergency_contact", $emergency_contact);
        $stmt->bindParam(":blood_group", $blood_group);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":pincode", $pincode);
        $stmt->bindParam(":city_parent_id", $city_parent_id);
        $stmt->bindParam(":state_parent_id", $state_parent_id);
        
        return $stmt->execute();
    }

    public function editTeacher($user_parent_id, $user_name, $teacher_phone, $teacher_email, $teacher_address, $course_parent_id, $qualification, $teacher_exp) {
        $query = "UPDATE teachers s
                  LEFT JOIN users u ON s.user_parent_id = u.user_id
                  SET u.user_name = :user_name, 
                      s.teacher_phone = :teacher_phone, 
                      s.teacher_email = :teacher_email, 
                      s.teacher_address = :teacher_address, 
                      s.course_parent_id = :course_parent_id, 
                      s.qualification = :qualification, 
                      s.teacher_exp = :teacher_exp
                  WHERE s.user_parent_id = :user_parent_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":user_parent_id", $user_parent_id);
        $stmt->bindParam(":teacher_phone", $teacher_phone);
        $stmt->bindParam(":teacher_email", $teacher_email);
        $stmt->bindParam(":teacher_address", $teacher_address);
        $stmt->bindParam(":course_parent_id", $course_parent_id);
        $stmt->bindParam(":qualification", $qualification);
        $stmt->bindParam(":teacher_exp", $teacher_exp);
        
        return $stmt->execute();
    }
    
    public function updatePassword($user_name, $user_password) {
        $query = "UPDATE users SET user_password = :user_password WHERE user_name = :user_name";
        $stmt = $this->db->prepare($query);
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":user_password", $hashed_password);
        return $stmt->execute();
    }
}
?>
