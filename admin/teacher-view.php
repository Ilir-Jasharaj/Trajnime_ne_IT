<?php
session_start();
if (
  isset($_SESSION['admin_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Admin') {
    include "../DB_connection.php";
    include "data/teacher.php";
    include "data/subject.php";
    include "data/section.php";
    include "data/class.php";

    if (isset($_GET['teacher_id'])) {

      $teacher_id = $_GET['teacher_id'];

      $teacher = getTeacherById($teacher_id, $conn);
?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Teachers</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../Logo 1_a v5.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style> 
        body {
          background-color: #f5f5f5;
        }

        .container-main {
          display: flex;
          align-items: center;
          margin: 100px;
        }

        .container {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
        }

        .figure {
          max-width: 50%;
          height: auto;
          border-radius: 4px;
          overflow: hidden;
          margin-left: 50px;
        }

        .figure img {
          max-width: 100%;
          height: auto;
          box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }

        .text {
          padding: 20px;
          margin-left: 180px;
          height: auto;
          width: 600px;
          background-color: #ffffff;
          box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }

        h2 {
          font-size: 24px;
          color: #333333;
          margin-bottom: 10px;
        }

        p {
          font-size: 14px;
          color: #666666;
        }
        </style>
      </head>

      <body>
        <?php
        include "inc/navbar.php";
        if ($teacher != 0) {
        ?>
          <div class="container-main mt-5">
            <div class="figure">
            <div class="card" style="width: 22rem;">
              <img src="../img/teacher-<?= $teacher['gender'] ?>.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title text-center">@<?= $teacher['username'] ?></h5>
              </div>
            </div>
            </div>

            <div class="text">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">First name: <?= $teacher['fname'] ?></li>
                <li class="list-group-item">Last name: <?= $teacher['lname'] ?></li>
                <li class="list-group-item">Username: <?= $teacher['username'] ?></li>

                <li class="list-group-item">Employee number: <?= $teacher['employee_number'] ?></li>
                <li class="list-group-item">Address: <?= $teacher['address'] ?></li>
                <li class="list-group-item">Date of birth: <?= $teacher['date_of_birth'] ?></li>
                <li class="list-group-item">Phone number: <?= $teacher['phone_number'] ?></li>
                <li class="list-group-item">Qualification: <?= $teacher['qualification'] ?></li>
                <li class="list-group-item">Email address: <?= $teacher['email_address'] ?></li>
                <li class="list-group-item">Gender: <?= $teacher['gender'] ?></li>
                <li class="list-group-item">Date of joined: <?= $teacher['date_of_joined'] ?></li>

                <li class="list-group-item">Subject:
                  <?php
                  $s = '';
                  $subjects = str_split(trim($teacher['subjects']));
                  foreach ($subjects as $subject) {
                    $s_temp = getSubjectById($subject, $conn);
                    if ($s_temp != 0)
                      $s .= $s_temp['subject_code'] . ', ';
                  }
                  echo $s;
                  ?>
                </li>
                <li class="list-group-item">Class:
                  <?php
                  $c = '';
                  $classes = str_split(trim($teacher['class']));

                  ?>
                </li>

              </ul>
              <div class="card-body">
                <a href="teacher.php" class="card-link">Go Back</a>
              </div>
            </div>
            </div>
          </div>
        <?php
        } else {
          header("Location: teacher.php");
          exit;
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
          $(document).ready(function() {
            $("#navLinks li:nth-child(2) a").addClass('active');
          });
        </script>

      </body>

      </html>
<?php

    } else {
      header("Location: teacher.php");
      exit;
    }
  } else {
    header("Location: ../login.php");
    exit;
  }
} else {
  header("Location: ../login.php");
  exit;
}

?>