<?php
require_once 'models/ViewEvaluationModel.php';

class TaskController {
    private $taskModel;

    public function __construct($db) {
        $this->taskModel = new TaskModel($db);
    }

    public function getTaskDetails($task_manager_id) {
        return $this->taskModel->getTaskDetails($task_manager_id);
    }
}
?>