<?php

require_once 'controllers/ClassDetailController.php';
require_once 'config/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['class_id'])) {
        $class_id = $_GET['class_id'];

        $taskController = new TaskController($db);

        $classDetails = $taskController->getClassDetails($class_id);

        $enrolledStudents = $taskController->getEnrolledStudents($class_id);

        $uploadedTasks = $taskController->getUploadedTasks($class_id);

        $classComments = $taskController->getClassComments($class_id);

        header('Content-Type: application/json');
        echo json_encode([
            'classDetails' => $classDetails,
            'enrolledStudents' => $enrolledStudents,
            'uploadedTasks' => $uploadedTasks,
            'classComments' => $classComments
        ]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No class_id provided']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Unsupported request method']);
}

?>
