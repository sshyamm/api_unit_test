<?php
require_once 'models/AddStudentsToClassModel.php';

class AddStudentsToClassController {
    private $model;

    public function __construct($db) {
        $this->model = new AddStudentsToClassModel($db);
    }

    public function getStudentsForClass($class_id) {
        return $this->model->getStudentsForClass($class_id);
    }
}
?>
