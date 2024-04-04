<?php

class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getClassDetails($class_id) {
        $sql = "SELECT ti.*, 
                c.course_name,
                c.course_desc,
                us.user_name AS teacher_name,
                ti.sched_start_time,
                ti.sched_end_time,
                ti.date_of_class,
                ti.class_status,
                ti.actual_start_time,
                ti.actual_end_time
            FROM classes ti
            LEFT JOIN courses c ON ti.course_parent_id = c.course_id
            LEFT JOIN users us ON ti.user_parent_id = us.user_id
            WHERE ti.class_id = :class_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEnrolledStudents($class_id) {
        $sql = "SELECT cr.class_room_id,
                    stu.user_name AS student_name,
                    s.email AS student_email,
                    cr.attendance AS attendance_status
                FROM class_rooms cr
                LEFT JOIN users stu ON cr.user_parent_id = stu.user_id
                LEFT JOIN students s ON stu.user_id = s.user_parent_id
                WHERE cr.class_parent_id = :class_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUploadedTasks($class_id) {
        $sql = "SELECT task_id, task_desc, task_deadline, task_file
                FROM class_tasks
                WHERE date_parent_id = :class_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClassComments($class_id) {
        $sql = "SELECT u.user_name, cc.comment, cc.created_at 
                FROM class_comments cc
                INNER JOIN users u ON cc.user_parent_id = u.user_id
                WHERE cc.class_parent_id = :class_id
                ORDER BY cc.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
