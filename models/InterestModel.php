<?php
class InterestModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function processInterest($user_id, $course_id) {
        $sql = "SELECT COUNT(*) AS count FROM interests WHERE user_parent_id = :user_id AND course_parent_id = :course_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {
            $insertSql = "INSERT INTO interests (user_parent_id, course_parent_id) VALUES (:user_id, :course_id)";
            $insertStmt = $this->db->prepare($insertSql);
            $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insertStmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
            if ($insertStmt->execute()) {
                return "success";
            } else {
                return "error";
            }
        } else {
            return "already_applied";
        }
    }
}
?>
