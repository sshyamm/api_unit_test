<?php

class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function processTaskData($task_desc, $task_deadline, $task_file, $class_id, $edit_task_id) {
        if (!empty($edit_task_id)) {
            return $this->updateTask($task_desc, $task_deadline, $task_file, $edit_task_id);
        } else {
            return $this->insertTask($task_desc, $task_deadline, $task_file, $class_id);
        }
    }

    private function updateTask($task_desc, $task_deadline, $task_file, $edit_task_id) {
        $query = "SELECT COUNT(*) as count FROM class_tasks WHERE task_id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task_id', $edit_task_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result || $result['count'] == 0) {
            return "task_not_found"; 
        }

        $new_file_name = null;
        if ($task_file && $task_file['error'] === UPLOAD_ERR_OK) {
            $file_name = $task_file['name'];
            $file_tmp = $task_file['tmp_name'];

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $file_ext;
            $upload_dir = "/opt/lampp/htdocs/music_academy/admin/getForms/uploads/";

            if (!move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                return "file_upload_error";
            }
        }

        $sql = "UPDATE class_tasks SET task_desc = :task_desc, task_deadline = :task_deadline";
        if ($new_file_name !== null) {
            $sql .= ", task_file = :task_file";
        }
        $sql .= " WHERE task_id = :task_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_desc', $task_desc);
        $stmt->bindParam(':task_deadline', $task_deadline);
        if ($new_file_name !== null) {
            $stmt->bindParam(':task_file', $new_file_name);
        }
        $stmt->bindParam(':task_id', $edit_task_id);
        
        return $stmt->execute();
    }

    private function insertTask($task_desc, $task_deadline, $task_file, $class_id) {
        $new_file_name = null;
        if ($task_file && $task_file['error'] === UPLOAD_ERR_OK) {
            $file_name = $task_file['name'];
            $file_tmp = $task_file['tmp_name'];

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $file_ext;
            $upload_dir = "/opt/lampp/htdocs/music_academy/admin/getForms/uploads/";

            if (!move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                return "file_upload_error";
            }
        }

        $query = "SELECT course_parent_id FROM classes WHERE class_id = :class_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return "class_not_found"; 
        }

        $course_parent_id = $result['course_parent_id'];

        $sql = "INSERT INTO class_tasks (task_desc, task_file, date_parent_id, course_parent_id, task_deadline) VALUES (:task_desc, :task_file, :class_id, :course_parent_id, :task_deadline)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_desc', $task_desc);
        $stmt->bindParam(':task_file', $new_file_name);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':course_parent_id', $course_parent_id);
        $stmt->bindParam(':task_deadline', $task_deadline);

        return $stmt->execute();
    }
}

?>
