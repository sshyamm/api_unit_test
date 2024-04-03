<?php

require_once 'models/TaskModel.php';

class TaskController {
    private $model;

    public function __construct($db) {
        $this->model = new TaskModel($db);
    }

    public function handleTaskRequest($task_desc, $task_deadline, $task_file, $class_id, $edit_task_id) {
        if (!$task_desc || !$task_deadline) {
            return json_encode(array("success" => false, "message" => "Missing or null parameters."));
        }

        $result = $this->model->processTaskData($task_desc, $task_deadline, $task_file, $class_id, $edit_task_id);

        if ($result === false) {
            return json_encode(array("success" => false, "message" => "Failed to " . (!empty($edit_task_id) ? "update" : "create") . " task."));
        } elseif ($result === "file_upload_error") {
            return json_encode(array("success" => false, "message" => "Failed to move uploaded file."));
        } elseif ($result === "class_not_found") {
            return json_encode(array("success" => false, "message" => "Class not found."));
        } elseif ($result === "task_not_found") {
            return json_encode(array("success" => false, "message" => "Task not found."));
        } else {
            return json_encode(array("success" => true, "message" => "Task " . (!empty($edit_task_id) ? "updated" : "created") . " successfully."));
        }
    }
}

?>
