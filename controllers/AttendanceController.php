<?php

require_once 'models/AttendanceModel.php';

class AttendanceController {
    private $model;

    public function __construct($db) {
        $this->model = new AttendanceModel($db);
    }

    public function updateAttendance($class_room_id, $attendance) {
        $result = $this->model->updateAttendance($class_room_id, $attendance);

        if ($result) {
            return json_encode(array("success" => true, "message" => "Attendance updated successfully."));
        } else {
            return json_encode(array("success" => false, "message" => "Failed to update attendance."));
        }
    }
}

?>
