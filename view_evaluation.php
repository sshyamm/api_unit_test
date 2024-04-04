<?php

require_once 'controllers/ViewEvaluationController.php';
require_once 'config/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['task_manager_id'])) {
        $task_manager_id = $_GET['task_manager_id'];
        
        $taskController = new TaskController($db);

        $viewEvaluation = $taskController->getTaskDetails($task_manager_id);

        if ($viewEvaluation) {
            header('Content-Type: application/json');
            echo json_encode($viewEvaluation);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Task details not found']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No task manager ID given']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Unsupported request method']);
}

?>
