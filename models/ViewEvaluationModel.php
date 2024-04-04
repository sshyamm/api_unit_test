<?php

class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTaskDetails($task_manager_id) {
        $sql = "SELECT ct.task_desc, u.user_name, tm.last_updated, tm.submit_status, tm.remark, tm.comment, tm.grading, tm.file_path
                FROM tasks tm
                JOIN class_tasks ct ON tm.task_parent_id = ct.task_id
                JOIN users u ON tm.user_parent_id = u.user_id
                WHERE tm.task_manager_id = :task_manager_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_manager_id', $task_manager_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>