<?php

require_once 'models/ClassModel.php';
require_once 'config/config.php'; 

class ClassController {
    private $model;

    public function __construct($db) {
        $this->model = new ClassModel($db);
    }

    public function getAllCourses() {
        $allCourses = $this->model->getAllCourses();
        if ($allCourses) {
            return json_encode(array("success" => true, "courses" => $allCourses));
        } else {
            return json_encode(array("success" => false, "message" => "No courses found"));
        }
    }
}
?>