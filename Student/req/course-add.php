<?php
session_start();
if (isset($_SESSION['student_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Student') {
        if (isset($_POST['course_name']) && isset($_POST['course_code'])) {
            include '../../DB_connection.php';

            $course_name = $_POST['course_name'];
            $course_code = $_POST['course_code'];

            if (empty($course_name)) {
                $em = "Course name is required";
                header("Location: ../course-add.php?error=$em");
                exit;
            } elseif (empty($course_code)) {
                $em = "Course code is required";
                header("Location: ../course-add.php?error=$em");
                exit;
            } else {
                // Check if the subject code exists in the list of subjects added by admin
                $sql_subjects = "SELECT * FROM subjects WHERE subject_code=?";
                $stmt_subjects = $conn->prepare($sql_subjects);
                $stmt_subjects->execute([$course_code]);

                if ($stmt_subjects->rowCount() == 0) {
                    $em = "The course is not available for registration";
                    header("Location: ../course-add.php?error=$em");
                    exit;
                } else {
                    $student_id = $_SESSION['student_id'];

                    // Check if the student is already enrolled in the selected subject
                    $sql_check = "SELECT * FROM student_subjects WHERE student_id=? AND s_subject_code=?";
                    $stmt_check = $conn->prepare($sql_check);
                    $stmt_check->execute([$student_id, $course_code]);

                    if ($stmt_check->rowCount() > 0) {
                        $em = "You are already enrolled in this course";
                        header("Location: ../course-add.php?error=$em");
                        exit;
                    } else {
                        // Insert the selected subject into the student_subjects table
                        $sql_insert = "INSERT INTO student_subjects (student_id, subject_id, s_subject, s_subject_code) SELECT ?, subject_id, ?, ? FROM subjects WHERE subject_code=?";
                        $stmt_insert = $conn->prepare($sql_insert);
                        $stmt_insert->execute([$student_id, $course_name, $course_code, $course_code]);

                        $sm = "New course added successfully";
                        header("Location: ../course-add.php?success=$sm");
                        exit;
                    }
                }
            }
        } else {
            $em = "An error occurred";
            header("Location: ../course-add.php?error=$em");
            exit;
        }
    } else {
        header("Location: ../../logout.php");
        exit;
    }
} else {
    header("Location: ../../logout.php");
    exit;
}
?>

