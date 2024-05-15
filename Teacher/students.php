<?php
session_start();
if (
  isset($_SESSION['teacher_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Teacher') {
    include "../DB_connection.php";
    include "data/class.php";
    include "data/section.php";
    include "data/teacher.php";

    $teacher_id = $_SESSION['teacher_id'];
    $teacher = getTeacherById($teacher_id, $conn);
    $classes = getAllClasses($conn);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Teachers - Students</title>
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

        .container {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
        }

        .container-main {
          margin-left: 300px;
          margin-bottom: 60px;
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
      if ($classes != 0) {
      ?>
        <div class="container-main mt-5">

          <div class="table-responsive">
            <table class="table table-bordered mt-3 n-table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Class</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0;
                foreach ($classes as $class) {
                ?>


                  <?php
                  $classesx = str_split(trim($teacher['class']));
                  $section = getSectioById($class['section'], $conn);
                  $c = $section['section'];
                  foreach ($classesx as $class_id) {
                    if ($class_id == $class['class_id']) {
                      $i++; ?>
                      <tr>
                        <th scope="row"><?= $i ?></th>
                        <td> <a href="students_of_class.php?class_id=<?= $class['class_id'] ?>">
                            <?php echo $c; ?>
                          </a>
                        </td>
                      </tr>

                  <?php
                    }
                  }


                  ?>

                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } else { ?>
          <div class="alert alert-info .w-450 m-5" role="alert">
            Empty!
          </div>
        <?php } ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
          $(document).ready(function() {
            $("#navLinks li:nth-child(3) a").addClass('active');
          });
        </script>

    </body>
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify"> <i>Smart School </i> is an initiative to help the upcoming programmers with the code. <i>Smart School</i> focuses on providing the most efficient code or snippets as the code wants to be simple. We will help programmers build up concepts in different programming languages that include C, C++, Java, HTML, CSS, Bootstrap, JavaScript, PHP, Android, SQL and Algorithm.</p>
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