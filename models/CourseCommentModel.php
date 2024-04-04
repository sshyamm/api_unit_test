<?php
class CommentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function submitComment($comment, $user_id, $course_id) {
        $query = "INSERT INTO comments (user_parent_id, comment, course_parent_id, created_at, comment_status)
                  VALUES (:user_id, :comment, :course_id, NOW(), 'Active')";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':course_id', $course_id);
        return $stmt->execute();
    }

    public function getUserById($user_id) {
        $user_query = "SELECT user_name FROM users WHERE user_id = :user_id";
        $user_stmt = $this->db->prepare($user_query);
        $user_stmt->bindParam(':user_id', $user_id);
        $user_stmt->execute();
        return $user_stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
