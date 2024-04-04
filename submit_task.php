<?php

require_once 'controllers/TaskDetailController.php';
require_once 'config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['class_id']) && isset($_GET['task_id'])) {
        $class_id = $_GET['class_id'];
        $task_id = $_GET['task_id'];
        
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $user_id = isset($data['user_id']) ? $data['user_id'] : '';

        $taskController = new TaskController($db);

        $taskDetails = $taskController->getTaskDetails($class_id);

        $taskUserDetails = $taskController->getTaskUserDetails($task_id, $user_id);

        $uploadedTasks = $taskController->getUploadedTasks($task_id, $user_id);

        header('Content-Type: application/json');
        echo json_encode([
            'taskDetails' => $taskDetails,
            'taskUserDetails' => $taskUserDetails,
            'uploadedTasks' => $uploadedTasks
        ]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No class_id or task_id provided']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Unsupported request method']);
}

?>
