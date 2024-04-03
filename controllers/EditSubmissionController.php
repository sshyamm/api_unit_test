<?php
require_once 'models/EditSubmissionModel.php';

class SubmissionController {
    private $model;

    public function __construct($db) {
        $this->model = new SubmissionModel($db);
    }

    public function updateSubmission($task_manager_id, $remark, $file_path) {
        $result = $this->model->updateSubmission($task_manager_id, $remark, $file_path);

        if ($result) {
            return json_encode(array("success" => true, "message" => "Submission updated successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to update submission."));
        }
    }
}
?>
