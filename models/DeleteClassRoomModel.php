<?php
class DeleteClassRoomModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function deleteClassRoom($class_room_id) {
        $sql = "DELETE FROM class_rooms WHERE class_room_id = :class_room_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_room_id', $class_room_id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
?>
