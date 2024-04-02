<?php

require_once 'models/InfoModel.php';
require_once 'config/config.php'; 

class InfoController {
    private $model;

    public function __construct($db) {
        $this->model = new InfoModel($db);
    }

    public function getAllClassInfo($user_name, $user_type) {
        $classInfo = $this->model->getClassInfo($user_name, $user_type);
        if ($classInfo) {
            return json_encode(array("success" => true, "classes" => $classInfo));
        } else {
            return json_encode(array("success" => false, "message" => "No classes found for you"));
        }
    }
}
?>