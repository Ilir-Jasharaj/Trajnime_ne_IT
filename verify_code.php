<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Enter Code - Smart School</title> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="Logo 1_a v5.png">
</head>

<body class="body-login">
	<div class="black-fill"><br /> <br />
		<div class="d-flex justify-content-center align-items-center flex-column">
			<form class="login" method="post" action="verifyCode.ini.php" autocomplete="off">
				<div class="text-center">
					<img src="Logo 1_a v5.png" width="200" height="200">
				</div>
				<h2 style="text-align: center;">Enter code</h2>
				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?= $_GET['error'] ?>
					</div>
				<?php } ?>
				<div class="my-5 mx-5">
					<label class="form-label">Enter code</label>
					<input type="text" class="form-control" name="code" required pattern="[0-9]{6}">
				</div>
				<input type="hidden" name="email" value="<?= $_GET['email'] ?>">
				<div class="text-center">
					<button type="submit" class="btn btn-primary" style="width: 200px;">Verify account</button>
				</div>
				<div class="text-center mt-5">
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