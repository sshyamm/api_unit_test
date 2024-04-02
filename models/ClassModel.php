<?php

class ClassModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCourses() {
        $stmt = $this->db->query("SELECT * FROM courses");
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $courses;
    }
}
?>