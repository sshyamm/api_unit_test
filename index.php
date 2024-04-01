<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'controllers/UserController.php';
require_once 'config/config.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$action = isset($data['action']) ? $data['action'] : '';

$userController = new UserController();

switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = isset($data['user_name']) ? $data['user_name'] : '';
            $user_password = isset($data['user_password']) ? $data['user_password'] : '';

            echo $userController->createUser($user_name, $user_password);
        } else {
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = isset($data['user_name']) ? $data['user_name'] : '';
            $user_password = isset($data['user_password']) ? $data['user_password'] : '';

            echo $userController->loginUser($user_name, $user_password);
        } else {
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    case 'profile':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = isset($data['user_id']) ? $data['user_id'] : '';

            echo $userController->getUserProfile($user_id);
        } else {
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    case 'edit_student':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_parent_id = isset($data['user_parent_id']) ? $data['user_parent_id'] : '';
            $user_name = isset($data['user_name']) ? $data['user_name'] : '';
            $phone_num = isset($data['phone_num']) ? $data['phone_num'] : '';
            $email = isset($data['email']) ? $data['email'] : '';
            $age_group_parent_id = isset($data['age_group_parent_id']) ? $data['age_group_parent_id'] : '';
            $course_parent_id = isset($data['course_parent_id']) ? $data['course_parent_id'] : '';
            $level_parent_id = isset($data['level_parent_id']) ? $data['level_parent_id'] : '';
            $emergency_contact = isset($data['emergency_contact']) ? $data['emergency_contact'] : '';
            $blood_group = isset($data['blood_group']) ? $data['blood_group'] : '';
            $address = isset($data['address']) ? $data['address'] : '';
            $pincode = isset($data['pincode']) ? $data['pincode'] : '';
            $city_parent_id = isset($data['city_parent_id']) ? $data['city_parent_id'] : '';
            $state_parent_id = isset($data['state_parent_id']) ? $data['state_parent_id'] : '';

            echo $userController->editStudent($user_parent_id, $user_name, $phone_num, $email, $age_group_parent_id, $course_parent_id, $level_parent_id, $emergency_contact, $blood_group, $address, $pincode, $city_parent_id, $state_parent_id);
        } else {
            http_response_code(405);
            echo json_encode(array("success" => false, "message" => "Method not allowed."));
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(array("success" => false, "message" => "Invalid endpoint."));
}
?>
