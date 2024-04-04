<?php

class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUploadedTasksByClass($task_id, $class_id) {
        $directory = "/opt/lampp/htdocs/music_academy/admin/getForms/uploads/";

        $sql_class_rooms = "SELECT cr.user_parent_id, u.user_name
                            FROM class_rooms cr
                            LEFT JOIN users u ON cr.user_parent_id = u.user_id
                            WHERE cr.class_parent_id = :class_id";
        $stmt_class_rooms = $this->db->prepare($sql_class_rooms);
        $stmt_class_rooms->bindParam(':class_id', $class_id);
        $stmt_class_rooms->execute();
        $class_room_users = $stmt_class_rooms->fetchAll(PDO::FETCH_ASSOC);

        $uploadedTasks = [];

        if ($class_room_users) {
            foreach ($class_room_users as $user) {
                $user_parent_id = $user['user_parent_id'];
                $user_name = $user['user_name'];

                $sql_tasks = "SELECT task_manager_id, file_path, remark, submit_status
                            FROM tasks
                            WHERE task_parent_id = :task_id
                            AND user_parent_id = :user_parent_id";
                $stmt_tasks = $this->db->prepare($sql_tasks);
                $stmt_tasks->bindParam(':task_id', $task_id);
                $stmt_tasks->bindParam(':user_parent_id', $user_parent_id);
                $stmt_tasks->execute();
                $task_details = $stmt_tasks->fetch(PDO::FETCH_ASSOC);

                $uploadedTasks[] = [
                    'user_name' => $user_name,
                    'file_path' => isset($task_details['file_path']) ? $task_details['file_path'] : 'No File Submitted',
                    'remark' => isset($task_details['remark']) ? $task_details['remark'] : 'N/A',
                    'submit_status' => isset($task_details['submit_status']) ? $task_details['submit_status'] : 'Not Submitted'                    
                ];
            }
        }

        return $uploadedTasks;
    }
}

?>
