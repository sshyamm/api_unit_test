<?php
class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertTask($data) {
        // Process data and insert task into database
        $remark = $data['remark'];
        $task_parent_id = isset($data['task_id']) ? $data['task_id'] : null;
        $user_parent_id = isset($data['user_id']) ? $data['user_id'] : null;

        // Validate if task_parent_id and user_parent_id are set
        if (is_null($task_parent_id) || is_null($user_parent_id)) {
            return "Task ID and user ID are required.";
        }

        $file_path = null;
        if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['file_path']['name'];
            $file_tmp = $_FILES['file_path']['tmp_name'];

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $file_ext;
            $upload_dir = "/opt/lampp/htdocs/music_academy/admin/getForms/uploads/";

            if (!move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                return "Failed to move uploaded file.";
            }

            $file_path = $new_file_name;
        }

        // Inserting current date and time into last_updated field
        $last_updated = date('Y-m-d H:i:s');

        $sql = "INSERT INTO tasks (task_parent_id, user_parent_id, remark, file_path, last_updated) VALUES (:task_parent_id, :user_parent_id, :remark, :file_path, :last_updated)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_parent_id', $task_parent_id);
        $stmt->bindParam(':user_parent_id', $user_parent_id);
        $stmt->bindParam(':remark', $remark);
        $stmt->bindParam(':file_path', $file_path);
        $stmt->bindParam(':last_updated', $last_updated);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error occurred.";
        }
    }
}
?>
