<?php
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Forgot Password - Smart School</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="Logo 1_a v5.png">
</head>

<body class="body-login">
	<div class="black-fill"><br /> <br />
		<div class="d-flex justify-content-center align-items-center flex-column">
			<form class="login" method="post" action="forgot.php">
				<div class="text-center">
					<img src="Logo 1_a v5.png" width="200" height="200">
				</div>
				<h2 style="text-align: center;">Forgot Password</h2>
				<?php if (isset($error)) { ?>
					<div class="alert alert-danger" role="alert">
						<?= $error ?>
					</div>
				<?php } ?>
				<div class="mb-3">
					<label class="form-label">Email Address</label>
					<input type="email" class="form-control" name="mail" required>
				</div>
				<div class="text-center mb-4">
					<button type="submit" class="btn btn-primary" style="width: 200px;">Send Verification Code</button>
				</div>
			</form>
			<br /><br />
			<div class="text-center text-light">
				<p>&copy; 2024 Smart School. All rights reserved.</p>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
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
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
?>