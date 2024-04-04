<?php
require_once 'models/NewsModel.php';

class NewsController {
    private $model;

    public function __construct($db) {
        $this->model = new SubscriptionModel($db);
    }

    public function handleSubscriptionRequest($email) {
        if (!empty($email)) {
            $result = $this->model->subscribe($email);
            if ($result) {
                return json_encode(['success' => true, 'message' => 'Subscription successful']);
            } else {
                return json_encode(['success' => false, 'message' => 'Failed to subscribe']);
            }
        } else {
            http_response_code(400);
            return json_encode(['success' => false, 'message' => 'Email is required']);
        }
    }
}
?>
