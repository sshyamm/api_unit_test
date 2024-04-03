<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

require_once 'controllers/EditSubmissionController.php';
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_manager_id = isset($data['task_manager_id']) ? $data['task_manager_id'] : null;
    $remark = isset($data['remark']) ? $data['remark'] : '';
    $file_path = isset($_FILES['file_path']) ? $_FILES['file_path'] : null;

    $controller = new SubmissionController($db);

    echo $controller->updateSubmission($task_manager_id, $remark, $file_path);
} else {
    echo json_encode(array("error" => "Invalid Request"));
}
?>
