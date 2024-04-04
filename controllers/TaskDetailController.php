<?php

require_once 'models/TaskDetailModel.php';

class TaskController {
    private $db;
    private $taskModel;

    public function __construct($db) {
        $this->db = $db;
        $this->taskModel = new TaskModel($db);
    }

    public function getTaskDetails($class_id) {
        return $this->taskModel->getTaskDetails($class_id);
    }

    public function getTaskUserDetails($task_id, $user_id) {
        return $this->taskModel->getTaskUserDetails($task_id, $user_id);
    }

    public function getUploadedTasks($task_id, $user_id) {
        return $this->taskModel->getUploadedTasks($task_id, $user_id);
    }
}

?>
