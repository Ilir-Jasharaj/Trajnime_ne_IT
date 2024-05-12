<?php
session_start();
if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])     &&
    isset($_GET['class_id'])
) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";
        include "data/class.php";
        include "data/section.php";

        $class = getClassById($_GET['class_id'], $conn);
        $sections = getAllSections($conn);


        if ($class == 0) {
            header("Location: class.php");
            exit;
        }


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Edit Class</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="icon" href="../Logo 1_a v5.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                body {
                    background-color: #f5f5f5;
                    font-family: Arial, sans-serif;
                }

                .container {
                    max-width: 600px;
                }

                .form-w {
                    background-color: white;
                    padding: 10px;
                    margin-top: 10px;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                }

                .form-w h3 {
                    font-size: 28px;
                    font-weight: 600;
                    margin-bottom: 20px;
                    color: #333333;
                }

                .form-w .form-label {
                    font-weight: 500;
                    color: #333333;
                }

                .form-w .form-control {
                    border-radius: 5px;
                    border: 1px solid #dddddd;
                    padding: 10px;
                    color: #333333;
                }

                .btn-dark {
                    background-color: #343a40;
                    border-color: #343a40;
                }

                .form-w .form-control:focus {
                    outline: none;
                    border-color: #4b7bec;
                    box-shadow: 0 0 0 0.2rem rgba(75, 123, 236, 0.25);
                }

                .form-w .btn-primary {
                    display: block;
                    margin: 20px auto 0;
                    padding: 12px 30px;
                    font-size: 18px;
                    font-weight: 600;
                    border-radius: 5px;
                    color: #ffffff;
                    background-color: #4b7bec;
                    border: none;
                    cursor: pointer;
                }

                .form-w .btn-primary:hover {
                    background-color: #3867d6;
                }

                .form-w .alert {
                    margin-bottom: 15px;
                }

                .alert-danger {
                    background-color: #f8d7da;
                    border-color: #f5c6cb;
                    color: #721c24;
                }

                .alert-success {
                    background-color: #d4edda;
                    border-color: #c3e6cb;
                    color: #155724;
                }

                @media screen and (max-width: 768px) {
                    .form-w {
                        padding: 20px;
                    }
                }
            </style>
        </head>

        <body>
            <?php
            include "inc/navbar.php";
            ?>
            <div class="container mt-5">
                <a href="class.php" class="btn btn-dark">Go Back</a>

                <form method="post" class="shadow p-3 mt-5 form-w" action="req/class-edit.php">
                    <h3>Edit Class</h3>
                    <hr>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['error'] ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['success'] ?>
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <select name="section" class="form-control">
                            <?php foreach ($sections as $section) {
                                $selected = 0;
                                if ($section['section_id'] == $class['section']) {
                                    $selected = 1;
                                }
                            ?>
                                <option value="<?= $section['section_id'] ?>" <?php if ($selected) echo "selected"; ?>>
                                    <?= $section['section'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="text" class="form-control" value="<?= $class['class_id'] ?>" name="class_id" hidden>

                    <button type="submit" class="btn btn-primary">
                        Update</button>
                </form>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $("#navLinks li:nth-child(6) a").addClass('active');
                    });
                </script>

        </body>

        </html>
<?php

    } else {
        header("Location: class.php");
        exit;
    }
} else {
    header("Location: class.php");
    exit;
}

?>