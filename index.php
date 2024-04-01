<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'controllers/UserController.php';
require_once 'config/config.php';

// Retrieve raw POST data
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$action = isset($data['action']) ? $data['action'] : '';

$userController = new UserController();

switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from decoded JSON
            $user_name = isset($data['user_name']) ? $data['user_name'] : '';
            $user_password = isset($data['user_password']) ? $data['user_password'] : '';

            // Call UserController method to create user
            echo $userController->createUser($user_name, $user_password);
        } else {
            // Method not allowed
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from decoded JSON
            $user_name = isset($data['user_name']) ? $data['user_name'] : '';
            $user_password = isset($data['user_password']) ? $data['user_password'] : '';

            // Call UserController method to perform login
            echo $userController->loginUser($user_name, $user_password);
        } else {
            // Method not allowed
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    case 'profile':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from decoded JSON
            $user_id = isset($data['user_id']) ? $data['user_id'] : '';

            // Call UserController method to fetch profile
            echo $userController->getUserProfile($user_id);
        } else {
            // Method not allowed
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    default:
        // Invalid endpoint
        http_response_code(404);
        echo json_encode(array("success" => false, "message" => "Invalid endpoint."));
}
?>
