<?php

require_once 'controllers/TaskViewController.php';
require_once 'config/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['task_id']) && isset($_GET['class_id'])) {
        $task_id = $_GET['task_id'];
        $class_id = $_GET['class_id'];
        
        $taskController = new TaskController($db);

        $uploadedTasks = $taskController->getUploadedTasksByClass($task_id, $class_id);

        header('Content-Type: application/json');
        echo json_encode($uploadedTasks);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No task_id or class_id provided']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Unsupported request method']);
}

?>
