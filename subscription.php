<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    require_once 'controllers/NewsController.php';
    require_once 'config/config.php';

    $controller = new NewsController($db);
    echo $controller->handleSubscriptionRequest($data['email']);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
