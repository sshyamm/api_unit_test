<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/AddStudentController.php';
require_once 'config/config.php';

$action = isset($data['action']) ? $data['action'] : '';

$controller = new AddStudentController($db);
$response = array();

switch ($action) {
    case 'add_student':
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['class_id']) && isset($data['selected_students'])) {
            $response = $controller->addStudentsToClass($data['class_id'], $data['selected_students']);
        } else {
            $response = array("success" => false, "message" => "Missing required data or invalid request method for adding students");
        }
        break;

    case 'remove_student':
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['class_room_id'])) {
            $response = $controller->removeStudentFromClass($data['class_room_id']);
        } else {
            $response = array("success" => false, "message" => "Missing class_room_id or invalid request method for removing student");
        }
        break;

    default:
        $response = array("success" => false, "message" => "Invalid action");
        break;
}

echo json_encode($response);
?>
