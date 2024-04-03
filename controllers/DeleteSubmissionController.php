<?php
require_once 'models/DeleteSubmissionModel.php';

class SubmissionController {
    private $model;

    public function __construct($db) {
        $this->model = new SubmissionModel($db);
    }

    public function deleteSubmission($task_manager_id) {
        $result = $this->model->deleteSubmission($task_manager_id);

        if ($result) {
            return json_encode(array("success" => true, "message" => "Submission deleted successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Submission not found or already deleted."));
        }
    }
}
?>
