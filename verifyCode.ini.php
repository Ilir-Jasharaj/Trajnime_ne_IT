<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the code and email address from the POST parameters
    $code = $_POST['code'];
    $email = $_POST['email'];

    // Validate the code and email address
    if (validateVerificationCode($email, $code)) {
        // Redirect to the change password page
        header('Location: changePassword.php?email=' . urlencode($email));
        exit;
    } else {
        // Code is invalid, redirect back to the form with an error message
        $error = 'Invalid code. Please try again.';
        header("Location: verify_code.php?error=" . urlencode($error) . "&email=" . urlencode($email));
        exit;
    }
} else {
    // Invalid request method, redirect back to the form
    header('Location: verify_code.php');
    exit;
}

function validateVerificationCode($email, $code)
{

    // Connect to the database
    $servername = "localhost: 3306";
    $username = "root";
    $password = "";
    $dbname = "sms_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the query to validate the verification code
    $email = $conn->real_escape_string($email);
    $code = $conn->real_escape_string($code);
    $sql = "SELECT * FROM admin WHERE email_address = '$email' AND activation = '$code'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if a matching row is found
    if ($result->num_rows > 0) {
        // Code is valid
        $conn->close();
        return true;
    } else {
        // Code is invalid
        $conn->close();
        return false;
    }
}
