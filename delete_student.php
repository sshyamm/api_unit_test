<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/DeleteClassRoomController.php';
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_room_id = isset($data['class_room_id']) ? $data['class_room_id'] : null;

    $controller = new DeleteClassRoomController($db);

    echo $controller->deleteClassRoom($class_room_id);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
