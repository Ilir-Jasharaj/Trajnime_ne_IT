<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['fname']) &&
            isset($_POST['lname']) &&
            isset($_POST['username']) &&
            isset($_POST['pass']) &&
            isset($_POST['address']) &&
            isset($_POST['gender']) &&
            isset($_POST['email_address']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['parent_fname']) &&
            isset($_POST['parent_lname']) &&
            isset($_POST['parent_phone_number']) &&
            isset($_POST['section'])
        ) {

            include '../../DB_connection.php';
            include "../data/student.php";

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['username'];
            $pass = $_POST['pass'];

            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $email_address = $_POST['email_address'];
            $date_of_birth = $_POST['date_of_birth'];
            $parent_fname = $_POST['parent_fname'];
            $parent_lname = $_POST['parent_lname'];
            $parent_phone_number = $_POST['parent_phone_number'];

            $section = $_POST['section'];

            if (empty($fname) ||
                empty($lname) ||
                empty($uname) ||
                empty($pass) ||
                empty($address) ||
                empty($gender) ||
                empty($email_address) ||
                empty($date_of_birth) ||
                empty($parent_fname) ||
                empty($parent_lname) ||
                empty($parent_phone_number) ||
                empty($section)
            ) {
                $response = array('status' => 'error', 'message' => 'All fields are required');
            } elseif (!unameIsUnique($uname, $conn)) {
                $response = array('status' => 'error', 'message' => 'Username is taken! Please try another');
            } else {
                // hashing the password
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql  = "INSERT INTO students(username, password, fname, lname, section, address, gender, email_address, date_of_birth, parent_fname, parent_lname, parent_phone_number) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $pass, $fname, $lname, $section, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_phone_number]);

                $response = array('status' => 'success', 'message' => 'New student registered successfully');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'An error occurred');
        }

        // Send the response back to the Ajax request
        echo json_encode($response);

    } else {
        $response = array('status' => 'error', 'message' => 'Unauthorized');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Unauthorized');
    echo json_encode($response);
}
?>
