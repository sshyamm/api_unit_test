<?php
class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function deleteTask($task_id) {
        $delete_sql = "DELETE FROM class_tasks WHERE task_id = :task_id";
        $delete_stmt = $this->db->prepare($delete_sql);
        $delete_stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        return $delete_stmt->execute();
    }
}
?>
