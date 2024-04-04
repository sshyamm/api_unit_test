<?php
require_once 'models/CourseDetailsModel.php';

class CourseDetailsController {
    private $model;

    public function __construct($db) {
        $this->model = new CourseDetailsModel($db);
    }

    public function getCourseDetails($course_id) {
        return $this->model->getCourseDetails($course_id);
    }

    public function getJumbotronImage() {
        return $this->model->getJumbotronImage();
    }
}
?>
