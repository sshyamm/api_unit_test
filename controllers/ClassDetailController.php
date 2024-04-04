<?php

require_once 'models/ClassDetailModel.php';

class TaskController {
    private $db;
    private $taskModel;

    public function __construct($db) {
        $this->db = $db;
        $this->taskModel = new TaskModel($db);
    }

    public function getClassDetails($class_id) {
        return $this->taskModel->getClassDetails($class_id);
    }

    public function getEnrolledStudents($class_id) {
        return $this->taskModel->getEnrolledStudents($class_id);
    }

    public function getUploadedTasks($class_id) {
        return $this->taskModel->getUploadedTasks($class_id);
    }

    public function getClassComments($class_id) {
        return $this->taskModel->getClassComments($class_id);
    }
}

?>
