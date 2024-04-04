<?php
require_once 'models/TeacherModel.php';

class TeacherController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new TeacherModel($this->db);
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
