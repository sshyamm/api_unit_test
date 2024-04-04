<?php

class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTaskDetails($class_id) {
        $sql = "SELECT ct.task_desc, ct.task_deadline, cr.course_name, u.user_name, c.date_of_class
                FROM class_tasks ct
                JOIN classes c ON ct.date_parent_id = c.class_id
                JOIN courses cr ON ct.course_parent_id = cr.course_id
                JOIN users u ON c.user_parent_id = u.user_id
                WHERE ct.date_parent_id = :class_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTaskUserDetails($task_id, $user_id) {
        $sql = "SELECT * FROM tasks WHERE task_parent_id = :task_id AND user_parent_id = :user_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result_task_info = $stmt->fetch(PDO::FETCH_ASSOC);

        $remark = $result_task_info['remark'];
        $file_path = $result_task_info['file_path'];
        $comment = $result_task_info['comment'];
        $grading = $result_task_info['grading'];
        $submit_status = '';

        if (!empty($grading)) {
            $submit_status = 'Graded & Completed';
        } elseif (!empty($remark) || !empty($file_path)) {
            $submit_status = 'Submitted For Review';
        } else {
            $submit_status = 'Pending';
        }

        $sql_update_submit_status = "UPDATE tasks SET submit_status = :submit_status WHERE task_parent_id = :task_id AND user_parent_id = :user_id";
        $stmt_update_submit_status = $this->db->prepare($sql_update_submit_status);
        $stmt_update_submit_status->bindParam(':submit_status', $submit_status);
        $stmt_update_submit_status->bindParam(':task_id', $task_id);
        $stmt_update_submit_status->bindParam(':user_id', $user_id);
        $stmt_update_submit_status->execute();
        
        $result_task_info['submit_status'] = $submit_status;

        return $result_task_info; 
    }
    public function getUploadedTasks($task_id, $user_id) {
        $sql = "SELECT task_manager_id, remark, file_path FROM tasks WHERE task_parent_id = :task_id AND user_parent_id = :user_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
