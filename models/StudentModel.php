<?php
class StudentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserProfile($user_id) {
        $sql = "SELECT s.*, 
                        ag.age_group_name, 
                        c.course_name, 
                        l.level_name, 
                        ci.city_name, 
                        st.state_name, 
                        co.country_name,
                        us.user_name
                FROM students s
                LEFT JOIN users us ON s.user_parent_id = us.user_id
                LEFT JOIN age_groups ag ON s.age_group_parent_id = ag.age_group_id
                LEFT JOIN courses c ON s.course_parent_id = c.course_id
                LEFT JOIN levels l ON s.level_parent_id = l.level_id
                LEFT JOIN cities ci ON s.city_parent_id = ci.city_id
                LEFT JOIN states st ON s.state_parent_id = st.state_id
                LEFT JOIN countries co ON s.country_parent_id = co.country_id
                WHERE s.user_parent_id = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        return $student;
    }
    public function getJumbotronImage() {
        $query_jumbotron = "SELECT * FROM images WHERE image_name = 'Jumbotron 3' AND image_status = 'Jumbotron'";
        $stmt_jumbotron = $this->db->query($query_jumbotron);
        return $stmt_jumbotron->fetch(PDO::FETCH_ASSOC);
    }
}
?>
