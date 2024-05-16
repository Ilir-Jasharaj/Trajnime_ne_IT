<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Smart School</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="Logo 1_a v5.png">
</head>

<body class="body-login">
	<div class="black-fill"><br /><br />
		<div class="d-flex justify-content-center align-items-center flex-column">
			<form class="login" method="post" action="req/login.php">

				<h2 style="text-align: center;" class="fw-bold fst-italic">Login</h2>
				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?= $_GET['error'] ?>
					</div>
				<?php } ?>

				<div class="mb-3">
					<label class="form-label">Username</label>
					<input type="text" class="form-control" name="uname" value="<?php if (isset($_COOKIE['username'])) {
																					echo $_COOKIE['username'];
																				} ?>">
				</div>

				<div class="mb-3">
					<label class="form-label">Password</label>
					<div class="input-group">
						<input type="password" class="form-control" name="pass" value="<?php if (isset($_COOKIE['password'])) {
																							echo $_COOKIE['password'];
																						} ?>">

					</div>
				</div>
				<div class="input-group-append">
					<div class="form-check d-flex justify-content-between mx-3 mb-3">
						<div>
							<input class="form-check-input" type="checkbox" name="remember" id="remember">
							<label class="form-check-label" for="remember">Remember Me</label>
						</div>
						<div>
							<a href="forgotPw.php" class="text-decoration-none pl-5 ml-6">Forgot Password?</a>
						</div>
					</div>
				</div>
				<div class="mb-5">
					<label class="form-label">Login As</label>
					<select class="form-control" name="role">
						<option value="1">Admin</option>
						<option value="2">Teacher</option>
						<option value="3">Student</option>
						<option value="4">Registrar Office</option>
					</select>
				</div>

				<div class="text-center mb-5">
					<button type="submit" class="btn btn-primary fw-bold fst-italic" style="width: 300px; height: 50px;">Login</button>
				</div>
			</form>

			<br /><br />
			<div class="text-center text-light">
				<?php
				//$pass = *****;
				 //$pass = password_hash($pass, PASSWORD_DEFAULT);
				 //echo $pass;
				?>
				<p>&copy; 2024 Smart School. All rights reserved.</p>
			</div> 
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>