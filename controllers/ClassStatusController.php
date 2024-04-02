<?php

require_once 'models/ClassStatusModel.php';

class ClassStatusController {
    private $model;

    public function __construct($db) {
        $this->model = new ClassStatusModel($db);
    }

    public function updateClassStatus($classId, $action) {
        $result = $this->model->updateClassStatus($classId, $action);

        if ($result['success']) {
            return json_encode(array("status" => "success", "message" => "Class status updated successfully.", "class_status" => $result['class_status']));
        } else {
            return json_encode(array("status" => "error", "message" => "Failed to update class status."));
        }
    }
}

?>
