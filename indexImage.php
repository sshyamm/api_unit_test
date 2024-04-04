<?php
require_once 'config/config.php';
require_once 'controllers/IndexController.php';

$imageController = new ImageController($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $images = $imageController->getActiveImages();
    $response = [
        'success' => true,
        'images' => $images
    ];

    header('Content-Type: application/json');

    echo json_encode($response);
} else {
    http_response_code(405); 
    echo json_encode(['error' => 'Unsupported request method']);
}
?>
