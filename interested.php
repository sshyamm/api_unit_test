<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    if(isset($data['user_id']) && isset($data['course_id'])) {
        $user_id = $data['user_id'];
        $course_id = $data['course_id'];

        require_once 'controllers/InterestController.php';
        require_once 'config/config.php';

        $controller = new InterestController($db);
        echo $controller->handleInterestRequest($user_id, $course_id);
    } else {
        echo json_encode(array("success" => false, "message" => "Missing user_id or course_id."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>
