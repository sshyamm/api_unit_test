<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/InfoController.php';
require_once 'config/config.php';

if (isset($data['user_name']) && isset($data['user_type'])) {
    $user_name = $data['user_name'];
    $user_type = $data['user_type'];

    $controller = new InfoController($db);

    echo $controller->getAllClassInfo($user_name, $user_type);
    
} else {
    echo json_encode(array("error" => "user_name and user_type are required"));
}
?>
