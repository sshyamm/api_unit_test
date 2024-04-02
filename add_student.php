<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/AddStudentController.php';
require_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($data['class_id']) && isset($data['selected_students'])) {
        $controller = new AddStudentController($db);

        $response = $controller->addStudentsToClass($data['class_id'], $data['selected_students']);

        echo json_encode($response);
    } else {
        echo json_encode(array("success" => false, "message" => "Missing required data"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
