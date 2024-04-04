<?php
class CommentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function submitComment($user_id, $class_id, $comment) {
        $stmt = $this->db->prepare("INSERT INTO class_comments (user_parent_id, class_parent_id, comment) VALUES (:user_id, :class_id, :comment)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':comment', $comment);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($user_id) {
        $stmt = $this->db->prepare("SELECT user_name FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
