<?php

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    require_once 'controllers/TaskController.php';
    require_once 'config/config.php';

    if(isset($data['task_desc']) && isset($data['task_deadline'])) {
        $task_desc = $data['task_desc'];
        $task_deadline = $data['task_deadline'];

        $task_file = isset($data['task_file']) ? $data['task_file'] : null;
        $class_id = isset($data['class_id']) ? $data['class_id'] : null;
        $edit_task_id = isset($data['edit_task_id']) ? $data['edit_task_id'] : null;

        $controller = new TaskController($db);
        echo $controller->handleTaskRequest($task_desc, $task_deadline, $task_file, $class_id, $edit_task_id);
    } else {
        echo json_encode(array("success" => false, "message" => "Missing or null parameters."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}

?>
