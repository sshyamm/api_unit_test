<?php
require_once 'models/StudentModel.php';

class StudentController {
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new StudentModel($this->db);
    }

    public function getUserProfile($user_id) {
        $profileInfo = $this->model->getUserProfile($user_id); 

        return $profileInfo;
    }

    public function getJumbotronImage() {
        return $this->model->getJumbotronImage(); 
    }
}
?>
