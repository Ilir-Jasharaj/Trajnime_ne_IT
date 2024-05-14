<?php
session_start();
if (isset($_SESSION['student_id']) && isset($_SESSION['role']) && isset($_GET['course_id'])) {
    if ($_SESSION['role'] == 'Student') {
        include "../DB_connection.php";
        include "data/subject.php";
        
        $course_id = $_GET['course_id'];

if (removeCourse($course_id, $conn)) {
    $sm = "Successfully deleted!";
    header("Location: course.php?success=$sm");
    exit;
} else {
    $em = "Unknown error occurred";
    header("Location: course.php?error=$em");
    exit;
}

    } else {
        header("Location: course.php");
        exit;
    }
} else {
    header("Location: course.php");
    exit;
}
?>
