<?php
session_start();
if (
  isset($_SESSION['r_user_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Registrar Office') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Registrar Office - Home</title>
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


        .row-cols-5 {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
        }

        .col {
          flex-basis: 20%;
          max-width: 20%;
          padding: 10px;
          text-align: center;
        }

        .col a {
          display: block;
          padding: 20px;
          border-radius: 5px;
          background-color: #f2f2f2;
          text-decoration: none;
          color: #333;
          transition: background-color 0.3s;
        }

        .col a:hover {
          background-color: #e0e0e0;
        }

        .col i {
          display: block;
          font-size: 24px;
          margin-bottom: 10px;
        }

        .col span {
          display: block;
        }

        .btn {
          font-size: 16px;
          border-radius: 3px;
        }

        .btn-dark {
          background-color: #333;
          color: #fff;
          border-color: #333;
        }

        .btn-dark:hover {
          background-color: #555;
          border-color: #555;
        }

        .btn-primary {
          background-color: #007bff;
          color: #fff;
          border-color: #007bff;
        }

        .btn-primary:hover {
          background-color: #0069d9;
          border-color: #0062cc;
        }

        .btn-warning {
          background-color: #ffc107;
          color: #fff;
          border-color: #ffc107;
        }

        .btn-warning:hover {
          background-color: #e0a800;
          border-color: #d39e00;
        }
      </style>
    </head>

    <body>
      <?php
      include "inc/navbar.php";
      ?>
      <div class="container mt-5">
        <div class="container text-center">
          <div class="row row-cols-5">
            <a href="student-add.php" class="col btn btn-dark m-2 py-3">
              <i class="fa fa-user-plus fs-1" aria-hidden="true"></i><br>
              Register Student
            </a>

            <a href="student.php" class="col btn btn-dark m-2 py-3">
              <i class="fa fa-user fs-1" aria-hidden="true"></i><br>
              All Students
            </a>

            <a href="../logout.php" class="col btn btn-warning m-2 py-3 col-5">
              <i class="fa fa-sign-out fs-1" aria-hidden="true"></i><br>
              Logout
            </a>
          </div>
        </div>
      </div>

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