<?php

require_once 'models/AddStudentModel.php';
require_once 'config/config.php'; 

class AddStudentController {
    private $model;

    public function __construct($db) {
        $this->model = new AddStudentModel($db);
    }

    public function addStudentsToClass($class_id, $selected_students) {
        if (!$class_id || empty($selected_students)) {
            return array("success" => false, "message" => "Invalid input data");
        }

        $result = $this->model->addStudentsToClass($class_id, $selected_students);

        if ($result) {
            return array("success" => true, "message" => "Students added to the class successfully");
        } else {
            return array("success" => false, "message" => "Failed to add students to the class");
        }
    }
}

?>
