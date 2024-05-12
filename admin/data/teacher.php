<?php  

// Get Teacher by ID
function getTeacherById($teacher_id, $conn){
   $sql = "SELECT * FROM teachers
           WHERE teacher_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$teacher_id]);

   if ($stmt->rowCount() == 1) {
     $teacher = $stmt->fetch();
     return $teacher;
   }else {
    return 0;
   }
}

// All Teachers 
function getAllTeachers($conn){
   $sql = "SELECT * FROM teachers";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $teachers = $stmt->fetchAll();
     return $teachers;
   }else {
   	return 0;
   }
}

// Check if the username Unique
function unameIsUnique($uname, $conn, $teacher_id=0){
   $sql = "SELECT username, teacher_id FROM teachers
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($teacher_id == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() >= 1) {
       $teacher = $stmt->fetch();
       if ($teacher['teacher_id'] == $teacher_id) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
   
}

// DELETE
function removeTeacher($id, $conn){
   $sql  = "DELETE FROM teachers
           WHERE teacher_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

// Search 
function searchTeachers($searchKey, $conn) {
  $query = "SELECT * FROM teachers WHERE fname LIKE :searchKey OR lname LIKE :searchKey";
  $stmt = $conn->prepare($query);
  $stmt->bindValue(':searchKey', "%$searchKey%", PDO::PARAM_STR);
  $stmt->execute();

  $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($teachers) {
      return $teachers;
  } else {
      return 0;
  }
}

// Function to retrieve subject name by subject ID
function getSubjectName($subjectId, $conn) {
  $query = "SELECT subject FROM subjects WHERE subject_id = :subjectId";
  $stmt = $conn->prepare($query);
  $stmt->bindValue(':subjectId', $subjectId, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
      return $result['subject'];
  } else {
      return null;
  }
}

?>

