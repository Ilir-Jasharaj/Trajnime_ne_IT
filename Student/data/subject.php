<?php 

// All Subjects
function getAllSubjects($conn){
   $sql = "SELECT * FROM student_subjects";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $subjects = $stmt->fetchAll();
     return $subjects;
   }else {
   	return [];
   }
}

// Get Subjects by ID
function getSubjectById($subject_id, $conn){
   $sql = "SELECT * FROM student_subjects
           WHERE subject_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$subject_id]);

   if ($stmt->rowCount() == 1) {
     $subject = $stmt->fetch();
     return $subject;
   }else {
   	return 0;
   }
}

function removeCourse($subject_id, $conn) {
  $sql = "DELETE FROM student_subjects
          WHERE subject_id=?";
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute([$subject_id]);
  if ($result) {
      return 1;
  } else {
      return 0;
  }
}
function getAllSubjects1($conn){
  $sql = "SELECT * FROM subjects";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() >= 1) {
    $subjects = $stmt->fetchAll();
    return $subjects;
  }else {
    return 0;
  }
}




function getStudentSubjects($conn, $student_id)
{
    $sql = "SELECT * FROM subjects WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); 
    }
}

?>





