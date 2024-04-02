<?php

class AttendanceModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function updateAttendance($class_room_id, $attendance) {

        $sql = "UPDATE class_rooms SET attendance = :attendance WHERE class_room_id = :class_room_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':attendance', $attendance);
        $stmt->bindParam(':class_room_id', $class_room_id);

        return $stmt->execute();
    }
}

?>
