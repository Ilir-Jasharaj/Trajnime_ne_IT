<?php
session_start();
if (
  isset($_SESSION['teacher_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Teacher') {
    include "../DB_connection.php";
    include "data/student.php";
    include "data/class.php";
    include "data/section.php";
    if (!isset($_GET['class_id'])) {
      header("Location: students.php");
      exit;
    }
    $class_id = $_GET['class_id'];
    $students = getAllStudents($conn);

    $class = getClassById($class_id, $conn);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Teacher - Students</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="icon" href="../Logo 1_a v5.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
        body {
          background-color: #f5f5f5;
        }

        .container {
          max-width: 600px;
          margin: 0 auto;
        }

        .n-table {
          width: 100%;
          border-collapse: collapse;
          background-color: #fff;
          box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }

        .n-table th,
        .n-table td {
          padding: 12px;
          text-align: center;
        }

        .n-table th {
          background-color: #f5f5f5;
          border-bottom: 1px solid #ddd;
          font-weight: bold;
        }

        .n-table td {
          border-bottom: 1px solid #ddd;
        }

        .alert {
          max-width: 450px;
          margin: 5rem auto;
          padding: 15px;
          background-color: #f5f5f5;
          border: 1px solid #ddd;
          border-radius: 4px;
          color: #333333;
        }

        .alert-info {
          background-color: #e7f0fd;
          border-color: #d0e5fc;
          color: #084a8c;
        }
      </style>
    </head>

    <body>
      <?php
      include "inc/navbar.php";
      if ($students != 0) {
        $check = 0;
      ?>

        <?php $i = 0;
        foreach ($students as $student) {

          $s = getSectioById($class['section'], $conn);
          if ($s['section_id'] == $student['section']) {
            $i++;
            if ($i == 1) {
              $check++;
        ?>
              <div class="container mt-5">
                <div class="table-responsive">
                  <table class="table table-bordered mt-3 n-table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php } ?>
                    <tr>
                      <th scope="row"><?= $i ?></th>
                      <td><?= $student['student_id'] ?></td>
                      <td>
                        <?= $student['fname'] ?>
                        </a>
                      </td>
                      <td><?= $student['lname'] ?></td>
                      <td><?= $student['username'] ?></td>
                    </tr>
                <?php }
            } ?>
                    </tbody>
                  </table>
                </div>
              <?php } else { ?>
                <div class="alert alert-info .w-450 m-5" role="alert">
                  Empty!
                </div>
              <?php } ?>
              </div>
              <?php if ($check == 0) {
                header("Location: students.php");
                exit;
              } ?>

              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
              <script>
                $(document).ready(function() {
                  $("#navLinks li:nth-child(3) a").addClass('active');
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