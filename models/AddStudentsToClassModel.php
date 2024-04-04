<?php
class AddStudentsToClassModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getStudentsForClass($class_id) {
        $students = [];

        $sql_students_interests = "SELECT u.user_id, u.user_name
               FROM users u
               JOIN interests i ON u.user_id = i.user_parent_id
               JOIN classes c ON i.course_parent_id = c.course_parent_id
               WHERE u.user_type='Student'
               AND c.class_id = :class_id";

        $sql_students_classrooms = "SELECT u.user_id, u.user_name
        FROM users u
        JOIN class_rooms c ON u.user_id = c.user_parent_id
        WHERE c.class_parent_id = :class_id";

        $sql_count_students_added = "SELECT COUNT(*) AS count
                                       FROM class_rooms cr
                                       WHERE cr.class_parent_id = :class_id
                                       AND cr.user_parent_id = :user_id";

        $stmt_students_interests = $this->db->prepare($sql_students_interests);
        $stmt_students_interests->bindParam(':class_id', $class_id, PDO::PARAM_INT);
        $stmt_students_interests->execute();
        $students_interests = $stmt_students_interests->fetchAll(PDO::FETCH_ASSOC);

        $stmt_students_classrooms = $this->db->prepare($sql_students_classrooms);
        $stmt_students_classrooms->bindParam(':class_id', $class_id, PDO::PARAM_INT);
        $stmt_students_classrooms->execute();
        $students_classrooms = $stmt_students_classrooms->fetchAll(PDO::FETCH_ASSOC);

        $students = array_merge($students_interests, $students_classrooms);
        $students = array_unique($students, SORT_REGULAR); 

        foreach ($students as &$student) {
            $stmt_count_students_added = $this->db->prepare($sql_count_students_added);
            $stmt_count_students_added->bindParam(':class_id', $class_id, PDO::PARAM_INT);
            $stmt_count_students_added->bindParam(':user_id', $student['user_id'], PDO::PARAM_INT);
            $stmt_count_students_added->execute();
            $result = $stmt_count_students_added->fetch(PDO::FETCH_ASSOC);
            $student['alreadyAdded'] = ($result['count'] > 0);
        }

        return $students;
    }
}
?>
