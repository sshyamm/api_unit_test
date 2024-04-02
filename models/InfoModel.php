<?php

class InfoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getClassInfo($user_name, $user_type) {
        $updateSql = "UPDATE classes ti
                      LEFT JOIN courses c ON ti.course_parent_id = c.course_id
                      LEFT JOIN users us ON ti.user_parent_id = us.user_id
                      SET ti.class_status = 
                          CASE 
                              WHEN ti.actual_start_time IS NULL AND ti.actual_end_time IS NULL THEN 'Upcoming'
                              WHEN ti.actual_start_time IS NULL AND ti.actual_end_time IS NOT NULL THEN 'Finished'
                              WHEN ti.actual_start_time IS NOT NULL AND ti.actual_end_time IS NULL THEN 'Ongoing'
                              ELSE 'Finished'
                          END";

        if ($user_type == 'Student') {
            $updateSql .= " WHERE ti.class_id IN (
                            SELECT cr.class_parent_id
                            FROM class_rooms cr
                            WHERE cr.user_parent_id = (
                                SELECT user_id
                                FROM users
                                WHERE user_name = :user_name
                            )
                        )";
        } else {
            $updateSql .= " WHERE us.user_name = :user_name";
        }

        $updateStmt = $this->db->prepare($updateSql);
        $updateStmt->bindParam(':user_name', $user_name);
        $updateStmt->execute();

        $selectSql = "SELECT ti.*, 
                              c.course_name,
                              us.user_name
                       FROM classes ti
                       LEFT JOIN courses c ON ti.course_parent_id = c.course_id
                       LEFT JOIN users us ON ti.user_parent_id = us.user_id";

        if ($user_type == 'Student') {
            $selectSql .= " WHERE ti.class_id IN (
                            SELECT cr.class_parent_id
                            FROM class_rooms cr
                            WHERE cr.user_parent_id = (
                                SELECT user_id
                                FROM users
                                WHERE user_name = :user_name
                            )
                        )";
        } else {
            $selectSql .= " WHERE us.user_name = :user_name";
        }

        $selectStmt = $this->db->prepare($selectSql);
        $selectStmt->bindParam(':user_name', $user_name);
        $selectStmt->execute();
        $data = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
?>
