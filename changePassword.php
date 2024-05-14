<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Besa iTech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="Logo 1_a v5.png">
</head>

<body class="body-login">
    <div class="black-fill"><br /> <br />
        <div class="d-flex justify-content-center align-items-center flex-column">
            <form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <div class="text-center">
                    <img src="Logo 1_a v5.png" width="200" height="200">
                </div>
                <h2 style="text-align: center;">Change Password</h2>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="uname">
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="width: 200px;">Change Password</button>
                </div>

                <div class="text-center mt-5">
                </div>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve the username from the form
                $uname = $_POST['uname'];

                // Retrieve the new password and confirm password from the form
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'];

                // Validate the new password and confirm password
                if ($newPassword !== $confirmPassword) {
                    echo "<div class='alert alert-danger' role='alert'>New password and confirm password do not match.</div>";
                } else {

                    $servername = "localhost:3307";
                    $username = "root";
                    $password = "";
                    $dbname = "sms_db";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Check if the username exists
                    $checkUsernameQuery = "SELECT username FROM admin WHERE username = '$uname'";
                    $checkUsernameResult = $conn->query($checkUsernameQuery);

                    if ($checkUsernameResult->num_rows === 0) {
                        echo "<div class='alert alert-danger' role='alert'>Invalid username.</div>";
                    } else {
                        $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);

                        $sql = "UPDATE admin SET password = '$newPasswordHashed' WHERE username = '$uname'";

                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success' role='alert'>Password updated successfully.</div>";
                            echo "<script>setTimeout(function() { window.location.href = 'login.php'; }, 3000);</script>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Error updating password: " . $conn->error . "</div>";
                        }
                    }

                    $conn->close();
                }
            }
            ?>

            <br /><br />
            <div class="text-center text-light">
                <p>&copy; 2023 Besa iTech. All rights reserved.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>