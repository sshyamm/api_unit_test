<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/EvaluateController.php';
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_manager_id = isset($data['task_manager_id']) ? $data['task_manager_id'] : null;
    $comment = isset($data['comment']) ? $data['comment'] : '';
    $grading = isset($data['grading']) ? $data['grading'] : '';

    if (empty($comment)) {
        echo json_encode(array("error" => "Comment is required"));
        exit();
    }

    $controller = new EvaluateController($db);

    echo $controller->EvaluateTask($comment, $grading, $task_manager_id);
    
} else {
    echo json_encode(array("error" => "Invalid Request"));
}
?>
