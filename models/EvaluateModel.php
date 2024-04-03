<?php
require_once 'config/config.php';

class EvaluateModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function updateTaskEvaluation($task_manager_id, $comment, $grading) {
        // Check if task manager ID exists
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM tasks WHERE task_manager_id = ?");
        $stmt->execute([$task_manager_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result || $result['count'] == 0) {
            return "task_not_found"; 
        }

        // Update task evaluation
        $stmt = $this->db->prepare("UPDATE tasks SET comment = ?, grading = ?, submit_status = CASE WHEN ? <> '' THEN 'Graded & Completed' ELSE 'Submitted For Review' END WHERE task_manager_id = ?");
        $stmt->execute([$comment, $grading, $grading, $task_manager_id]);

        return $stmt->rowCount() > 0;
    }
}
?>
