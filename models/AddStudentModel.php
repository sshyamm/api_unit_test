<?php

class AddStudentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addStudentsToClass($class_id, $selected_students) {
        $check_sql = "SELECT COUNT(*) AS count FROM class_rooms WHERE class_parent_id = :class_id AND user_parent_id = :user_id";
        $check_stmt = $this->db->prepare($check_sql);

        $insert_sql = "INSERT INTO class_rooms (user_parent_id, class_parent_id) VALUES (:user_id, :class_id)";
        $insert_stmt = $this->db->prepare($insert_sql);

        foreach ($selected_students as $user_id) {
            $check_stmt->bindParam(':class_id', $class_id);
            $check_stmt->bindParam(':user_id', $user_id);
            $check_stmt->execute();
            $result = $check_stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                $insert_stmt->bindParam(':user_id', $user_id);
                $insert_stmt->bindParam(':class_id', $class_id);
                $insert_stmt->execute();
            }
        }
        return true;
    }
    public function removeStudentFromClass($class_room_id) {
        $delete_sql = "DELETE FROM class_rooms WHERE class_room_id = :class_room_id";
        $delete_stmt = $this->db->prepare($delete_sql);
        $delete_stmt->bindParam(':class_room_id', $class_room_id);
        return $delete_stmt->execute();
    }
}

?>
