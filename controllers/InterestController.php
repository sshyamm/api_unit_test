<?php
require_once 'models/InterestModel.php';

class InterestController {
    private $model;

    public function __construct($db) {
        $this->model = new InterestModel($db);
    }

    public function handleInterestRequest($user_id, $course_id) {
        if (!$user_id || !$course_id) {
            return json_encode(array("success" => false, "message" => "Missing user_id or course_id."));
        }

        $result = $this->model->processInterest($user_id, $course_id);

        if ($result === "success") {
            return json_encode(array("success" => true, "message" => "Interest registered successfully."));
        } elseif ($result === "already_applied") {
            return json_encode(array("success" => false, "message" => "Interest already registered."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to register interest."));
        }
    }
}
?>
