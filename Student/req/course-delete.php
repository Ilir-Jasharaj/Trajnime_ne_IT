<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])     &&
    isset($_POST['course_id'])) {

  if ($_SESSION['role'] == 'Student') {
     include "../DB_connection.php";
     include "data/subject.php";

     $id = $_POST['course_id'];
     if (removeCourse($id, $conn)) {
        echo "success";
     } else {
        echo "error";
     }
  } else {
    echo "access denied";
  }
} else {
    echo "access denied";
}
?>
