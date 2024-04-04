<?php
class SubscriptionModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function subscribe($email) {
        $query = "INSERT INTO news (email) VALUES (:email)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
?>
