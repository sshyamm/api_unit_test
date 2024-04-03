<?php
require_once 'models/DeleteTaskModel.php';

class TaskController {
    private $model;

    public function __construct($db) {
        $this->model = new TaskModel($db);
    }

    public function deleteTask($task_id) {
        $result = $this->model->deleteTask($task_id);

        if ($result) {
            return json_encode(array("success" => true, "message" => "Task deleted successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to delete task."));
        }
    }
}
?>
