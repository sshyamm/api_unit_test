<?php

class ImageModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getActiveImages() {
        $images = [];
        $query = "SELECT * FROM images WHERE image_status = 'Active'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $images[] = $row;
        }

        return $images;
    }
}
?>
