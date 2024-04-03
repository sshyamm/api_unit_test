<?php
require_once 'models/DeleteClassRoomModel.php';

class DeleteClassRoomController {
    private $model;

    public function __construct($db) {
        $this->model = new DeleteClassRoomModel($db);
    }

    public function deleteClassRoom($class_room_id) {
        if (empty($class_room_id)) {
            return json_encode(['status' => 'error', 'message' => 'Class room ID is not provided']);
        }

        $result = $this->model->deleteClassRoom($class_room_id);

        if ($result) {
            return json_encode(['status' => 'success', 'message' => 'Class room deleted successfully']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed to delete class room']);
        }
    }
}
?>
