<?php
require_once 'controllers/AddStudentsToClassController.php';
require_once 'config/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['class_id'])) {
        $class_id = $_GET['class_id'];
        
        $controller = new AddStudentsToClassController($db);
        
        $students = $controller->getStudentsForClass($class_id);

        header('Content-Type: application/json');
        echo json_encode($students);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No class ID given']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Unsupported request method']);
}
?>
