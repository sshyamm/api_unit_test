<?php

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    require_once 'controllers/AttendanceController.php';
    require_once 'config/config.php';

    if(isset($data['class_room_id']) && isset($data['attendance'])) {
        $class_room_id = $data['class_room_id'];
        $attendance = $data['attendance'];

        $controller = new AttendanceController($db);
        echo $controller->updateAttendance($class_room_id, $attendance);
    } else {
        echo json_encode(array("success" => false, "message" => "Missing or null parameters."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}

?>
