<?php

require_once 'models/TaskViewModel.php';

class TaskController {
    private $db;
    private $taskModel;

    public function __construct($db) {
        $this->db = $db;
        $this->taskModel = new TaskModel($db);
    }

    public function getUploadedTasksByClass($task_id, $class_id) {
        return $this->taskModel->getUploadedTasksByClass($task_id, $class_id);
    }
}

?>
