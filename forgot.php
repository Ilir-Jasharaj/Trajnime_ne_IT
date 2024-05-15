<?php
// Generate a random verification code
$verificationCode = generateVerificationCode();

// Save the verification code in the database for the given user
$email = $_POST['mail']; // Get the email from the form
saveVerificationCode($email, $verificationCode);

// Send the email with the verification code
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['mail'];

    if (checkEmailExists($email)) {

        $verificationCode = generateVerificationCode();
        saveVerificationCode($email, $verificationCode);

        $apiUrl = 'https://api.elasticemail.com/v2/email/send';
        $apiKey = '8EC99B83A7ACB1D1E568C49BEC213FA207AFB54F3D6C44F4274415B111BC725067FCC77259B9A01CEB742ECAADAB0F00';
        $fromEmail = 'ilirjasharajj@gmail.com';
        $subject = 'Password Reset Code';
        $message = 'Your password reset code is: ' . $verificationCode;

        $data = array(
            'apikey' => $apiKey,
            'from' => $fromEmail,
            'subject' => $subject,
            'body' => $message,
            'to' => $email
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response !== false) {
            $responseData = json_decode($response);
            if ($responseData->success) {
                header('Location: verify_code.php?email=' . $email);
                exit;
            } else {
                $error = 'Email sending failed. Please try again.';
            }
        } else {
            $error = 'Email sending failed. Please try again.';
        }

        curl_close($ch);
    } else {
        $error = 'Email not found. Please enter a valid email address.';
    }
}
function checkEmailExists($email)
{
    $servername = "localhost: 3306";
    $username = "root";
    $password = "";
    $dbname = "sms_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Lidhja me bazën e të dhënave dështoi: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($email);
    $sql = "SELECT * FROM admin WHERE email_address = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $conn->close();
        return true;
    } else {
        $conn->close();
        return false;
    }
}

function generateVerificationCode($length = 6)
{
    $characters = '0123456789';
    $code = '';

    $characterCount = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $characterCount - 1);
        $code .= $characters[$randomIndex];
    }

    return $code;
}

function saveVerificationCode($email, $verificationCode)
{
    $servername = "localhost: 3306";
    $username = "root";
    $password = "";
    $dbname = "sms_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE admin SET activation = '$verificationCode' WHERE email_address = '$email'";

    if ($conn->query($sql) === true) {
        echo "Verification code saved successfully.";
    } else {
        echo "Error saving verification code: " . $conn->error;
    }

    $conn->close();
}
