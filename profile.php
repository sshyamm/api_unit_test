<?php
require_once 'config/config.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($data['user_id']) && isset($data['user_type'])) {
        $user_id = $data['user_id'];
        $user_type = $data['user_type'];

        if ($user_type === 'Student') {
            require_once 'controllers/StudentController.php';
            $controller = new StudentController($db);
        } elseif ($user_type === 'Teacher') {
            require_once 'controllers/TeacherController.php';
            $controller = new TeacherController($db);
        } else {
            echo json_encode(['error' => 'User type not recognized']);
            exit();
        }
        $jumbotronImage = $controller->getJumbotronImage();
        $profileInfo = $controller->getUserProfile($user_id);

        if ($profileInfo) {
            $response = [
                'success' => true,
                'jumbotron_image' => $jumbotronImage,
                'user_profile' => $profileInfo
            ];
        } else {
            $response = [
                'error' => 'User profile not found'
            ];
        }

        header('Content-Type: application/json');

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'User ID and user type are required']);
    }
} else {
    echo json_encode(array("error" => "Invalid Request"));
}
?>
