<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Kolkata');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    require_once 'controllers/CourseCommentController.php';
    require_once 'config/config.php';

    $controller = new CommentController($db);
    echo $controller->handleCommentRequest($data['comment'], $data['user_id'], $data['course_id']);
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
