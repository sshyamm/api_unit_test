<?php
require_once 'models/AddSubmissionModel.php';

class TaskController {
    private $model;

    public function __construct($db) {
        $this->model = new TaskModel($db);
    }

    public function handleTaskRequest($data) {
        if (!isset($data['remark'], $data['task_id'], $data['user_id'])) {
            return json_encode(array("success" => false, "message" => "Incomplete data. Please provide remark, task_id, and user_id."));
        }

        $result = $this->model->insertTask($data);

        if ($result === true) {
            return json_encode(array("success" => true, "message" => "Task inserted successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Error occurred: " . $result));
        }
    }
}
?>
