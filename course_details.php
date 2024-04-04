<?php
require_once 'controllers/CourseDetailsController.php';
require_once 'config/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];

        $controller = new CourseDetailsController($db);
        $courseDetails = $controller->getCourseDetails($course_id);
        $jumbotronImage = $controller->getJumbotronImage();

        $data = [
            'course_details' => $courseDetails,
            'jumbotron_image' => $jumbotronImage
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No course ID given']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Unsupported request method']);
}
?>
