<?php
session_start();
if (
  isset($_SESSION['teacher_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Teacher') {
    include "../DB_connection.php";
    include "data/teacher.php";
    include "data/subject.php";
    include "data/section.php";
    include "data/class.php";


    $teacher_id = $_SESSION['teacher_id'];
    $teacher = getTeacherById($teacher_id, $conn);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Teacher - Home</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/footer.css">
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
          flex: 1;
          max-width: 50%;
          height: auto;
          border-radius: 4px;
          overflow: hidden;
        }

        .figure img {
          max-width: 100%;
          height: auto;
          box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }

        .text {
          flex: 1;
          padding: 20px;
          height: auto;
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

                foreach ($classes as $class_id) {
                  $class = getClassById($class_id, $conn);


                  $section = getSectioById($class['section'], $conn);
                }
                echo $c;

                ?>
              </li>

            </ul>
          </div>
        </div>
      <?php
      } else {
        header("Location: logout.php?error=An error occurred");
        exit;
      }
      ?>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(1) a").addClass('active');
        });
      </script>
    </body>
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify"> <i>BIT </i> is an initiative to help the upcoming programmers with the code. <i>BIT</i> focuses on providing the most efficient code or snippets as the code wants to be simple. We will help programmers build up concepts in different programming languages that include C, C++, Java, HTML, CSS, Bootstrap, JavaScript, PHP, Android, SQL and Algorithm.</p>
          </div>
          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li>C</a></li>
              <li>C++</a></li>
              <li>HTML</a></li>
              <li>Java</a></li>
              <li>CSS</a></li>
              <li>Bootstrap</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="#home">Home</a></li>
              <li><a href="#about">About Us</a></li>
              <li><a href="#contact">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
<!---->
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