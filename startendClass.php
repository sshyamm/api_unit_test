<?php

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/ClassStatusController.php';
require_once 'config/config.php';

if (isset($data['action'])) {
    $action = $data['action'];
    $classId = $data['class_id'];

    $controller = new ClassStatusController($db);
    echo $controller->updateClassStatus($classId, $action);
} else {
    echo json_encode(array("status" => "error", "message" => "Action parameter is not set."));
}
?>
