<?php
class SubmissionModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function updateSubmission($task_manager_id, $remark, $file_path) {
        $update_sql = "UPDATE tasks SET remark = :remark, last_updated = NOW()";
        if (!empty($file_path)) {
            $file_name = $file_path['name'];
            $file_tmp = $file_path['tmp_name'];

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $file_ext;
            $upload_dir = "/opt/lampp/htdocs/music_academy/admin/getForms/uploads/";

            if (!move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                return false;
            }

            $update_sql .= ", file_path = :file_path";
        }
        $update_sql .= " WHERE task_manager_id = :task_manager_id";
        $update_stmt = $this->db->prepare($update_sql);
        $update_stmt->bindParam(':task_manager_id', $task_manager_id);
        $update_stmt->bindParam(':remark', $remark);
        if (!empty($file_path)) {
            $update_stmt->bindParam(':file_path', $new_file_name);
        }

        return $update_stmt->execute();
    }
}
?>
