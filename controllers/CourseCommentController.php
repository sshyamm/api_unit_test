<?php
require_once 'models/CourseCommentModel.php';

class CommentController {
    private $model;

    public function __construct($db) {
        $this->model = new CommentModel($db);
    }

    public function handleCommentRequest($comment, $user_id, $course_id) {
        if(isset($comment, $user_id, $course_id)) {
            $result = $this->model->submitComment($comment, $user_id, $course_id);

            if ($result === true) {
                $user = $this->model->getUserById($user_id);
                $new_comment_html = '<div class="comment">';
                $new_comment_html .= '<div class="meta">' . $user['user_name'] . ' - ' . date('jS F Y, h:i A') . '</div><span>&nbsp;</span>'; 
                $new_comment_html .= '<div class="user-content">' . htmlspecialchars($comment) . '</div>'; 
                $new_comment_html .= '</div>';
                return json_encode(array("success" => true, "message" => "Comment submitted successfully.", "html" => $new_comment_html));
            } else {
                return json_encode(array("success" => false, "message" => "Failed to submit comment."));
            }
        } else {
            return json_encode(array("success" => false, "message" => "Incomplete data. Please provide comment, user_id, and course_id."));
        }
    }
}
?>
