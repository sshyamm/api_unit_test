<?php
class CourseDetailsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getCourseDetails($course_id) {
        $courseDetails = [];

        $query = "SELECT c.*, u.user_name FROM courses c LEFT JOIN teachers t ON c.course_id = t.course_parent_id LEFT JOIN users u ON t.user_parent_id = u.user_id WHERE c.course_id = :course_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        $courseDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        return $courseDetails;
    }

    public function getJumbotronImage() {
        $query_jumbotron = "SELECT * FROM images WHERE image_name = 'Jumbotron 2' AND image_status = 'Jumbotron'";
        $stmt_jumbotron = $this->db->query($query_jumbotron);
        return $stmt_jumbotron->fetch(PDO::FETCH_ASSOC);
    }
}
?>
