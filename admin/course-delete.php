<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_POST['course_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../DB_connection.php";
     include "data/subject.php";

     $id = $_POST['course_id'];
     if (removeCourse($id, $conn)) {
     	$response = array('status' => 'success', 'message' => 'Course successfully deleted.');
     } else {
        $response = array('status' => 'error', 'message' => 'Unknown error occurred while deleting the course.');
     }
     echo json_encode($response);
     exit;

  } else {
    $response = array('status' => 'error', 'message' => 'Access denied.');
    echo json_encode($response);
    exit;
  }
} else {
	$response = array('status' => 'error', 'message' => 'Invalid request.');
	echo json_encode($response);
	exit;
}
?>
