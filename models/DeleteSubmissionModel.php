<?php
class SubmissionModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function deleteSubmission($task_manager_id) {
        $delete_sql = "DELETE FROM tasks WHERE task_manager_id = :task_manager_id";
        $delete_stmt = $this->db->prepare($delete_sql);
        $delete_stmt->bindParam(':task_manager_id', $task_manager_id);

        return $delete_stmt->execute();
    }
}
?>
