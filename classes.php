<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'controllers/ClassController.php';
require_once 'config/config.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$controller = new ClassController($db);
echo $controller->getAllCourses();
?>
