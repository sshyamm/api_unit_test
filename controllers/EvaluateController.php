<?php
require_once 'models/EvaluateModel.php';

class EvaluateController {
    private $model;

    public function __construct($db) {
        $this->model = new EvaluateModel($db);
    }

    public function EvaluateTask($comment, $grading, $task_manager_id) {
        $result = $this->model->updateTaskEvaluation($task_manager_id, $comment, $grading);

        if ($result === "task_not_found") {
            return json_encode(array("success" => false, "message" => "Task manager ID not found."));
        } elseif ($result) {
            return json_encode(array("success" => true, "message" => "Evaluation updated successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to update evaluation."));
        }
    }
}
?>
