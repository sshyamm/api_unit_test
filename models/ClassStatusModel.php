<?php

class ClassStatusModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function updateClassStatus($classId, $action) {
        $status = '';

        if ($action === "start") {
            $sql = "UPDATE classes SET actual_start_time = NOW(), class_status = 'Ongoing' WHERE class_id = :class_id";
            $status = 'Ongoing';
        } elseif ($action === "end") {
            $sql = "UPDATE classes SET actual_end_time = NOW(), class_status = 'Finished' WHERE class_id = :class_id";
            $status = 'Finished';
        } else {
            return array("success" => false); 
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_id', $classId);
        $success = $stmt->execute();

        if ($success) {
            return array("success" => true, "class_status" => $status);
        } else {
            return array("success" => false);
        }
    }
}

?>
