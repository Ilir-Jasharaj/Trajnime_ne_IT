<?php
session_start();
if (
  isset($_SESSION['admin_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Admin') {
    include '../DB_connection.php';

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin - Add Course</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="icon" href="../Logo 1_a v5.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #f7f7f7;
        }

        .container {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
          background-color: #fff;
          border-radius: 5px;
          box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-go-back {
          margin-bottom: 10px;
          background-color: #212529;
        }

        .form-w h3 {
          margin-bottom: 20px;
          text-align: center;
          background-color: #343a40;
          color: #fff;
          padding: 10px;
        }

        .form-w hr {
          border-top: 1px solid #ccc;
        }

        .btn-dark {
          background-color: #343a40;
          border-color: #343a40;
        }

        .alert {
          margin-top: 10px;
        }

        .btn-primary {
          background-color: #3867d6;
          border-color: #4caf50;
        }

        .btn-primary:hover {
          background-color: #45a049;
          border-color: #45a049;
        }
      </style>
    </head>

    <body>
      <?php
      include "inc/navbar.php";
      ?>
      <div class="container mt-5">
        <a href="course.php" class="btn btn-dark">Go Back</a> <br><br>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/course-add.php">

          <h3>Add New Course</h3>
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
            <label class="form-label">Course Name</label>
            <input type="text" class="form-control" name="course_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" class="form-control" name="course_code">
          </div>

          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(7) a").addClass('active');
        });
      </script>

    </body>

    </html>
<?php

  } else {
    header("Location: ../login.php");
    exit;
  }
} else {
  header("Location: ../login.php");
  exit;
}

?>