<?php
require_once 'models/CommentModel.php';

class CommentController {
    private $model;

    public function __construct($db) {
        $this->model = new CommentModel($db);
    }

    public function handleCommentRequest($user_id, $class_id, $comment) {
        if(isset($user_id, $class_id, $comment)) {
            $result = $this->model->submitComment($user_id, $class_id, $comment);

            if ($result === true) {
                $user = $this->model->getUserById($user_id);
                $output = '
                    <p><strong>' . $user['user_name'] . '</strong> - ' . date('jS F Y, h:i A') . '</p>
                    <p>' . $comment . '</p>
                    <hr>
                ';
                return json_encode(array("success" => true, "message" => "Comment submitted successfully.", "html" => $output));
            } else {
                return json_encode(array("success" => false, "message" => "Failed to submit comment."));
            }
        } else {
            return json_encode(array("success" => false, "message" => "Incomplete data. Please provide user_id, class_id, and comment."));
        }
    }
}
?>
