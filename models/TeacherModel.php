<?php
class TeacherModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserProfile($user_id) {
        $sql = "SELECT t.*, 
                        c.course_name,
                        us.user_name
                FROM teachers t
                LEFT JOIN users us ON t.user_parent_id = us.user_id
                LEFT JOIN courses c ON t.course_parent_id = c.course_id
                WHERE t.user_parent_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id]);
        $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

        return $teacher;
    }
    public function getJumbotronImage() {
        $query_jumbotron = "SELECT * FROM images WHERE image_name = 'Jumbotron 3' AND image_status = 'Jumbotron'";
        $stmt_jumbotron = $this->db->query($query_jumbotron);
        return $stmt_jumbotron->fetch(PDO::FETCH_ASSOC);
    }
}
?>
