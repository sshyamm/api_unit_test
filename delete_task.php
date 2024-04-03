<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/DeleteTaskController.php';
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = isset($data['task_id']) ? $data['task_id'] : null;

    $controller = new TaskController($db);

    echo $controller->deleteTask($task_id);
} else {
    echo json_encode(array("error" => "Invalid Request"));
}
?>
