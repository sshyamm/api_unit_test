<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    require_once 'controllers/AddSubmissionController.php';
    require_once 'config/config.php';

    $controller = new TaskController($db);
    echo $controller->handleTaskRequest($data);
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
