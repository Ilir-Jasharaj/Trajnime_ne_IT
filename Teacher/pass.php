<?php
session_start();
if (
  isset($_SESSION['teacher_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Teacher') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Teacher - Change Password</title>
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

        .form-w {
          background-color: white;
          padding: 10px;
          margin-top: 10px;
          border-radius: 10px;
          box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
      </style>
    </head>

    <body>
      <?php
      include "inc/navbar.php";
      ?>
      <div class="d-flex justify-content-center align-items-center flex-column">
        <form method="post" class="shadow p-3 my-5 form-w" action="req/teacher-change.php" id="change_password">
          <h3>Change Password</h3>
          <hr>
          <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
              <?= $_GET['perror'] ?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
              <?= $_GET['psuccess'] ?>
            </div>
          <?php } ?>

          <div class="mb-3">
            <div class="mb-3">
              <label class="form-label">Old password</label>
              <input type="password" class="form-control" name="old_pass">
            </div>

            <label class="form-label">New password </label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="new_pass" id="passInput">
              <button class="btn btn-secondary" id="gBtn">
                Random</button>
            </div>

          </div>

          <div class="mb-3">
            <label class="form-label">Confirm new password </label>
            <input type="text" class="form-control" name="c_new_pass" id="passInput2">
          </div>
          <button type="submit" class="btn btn-primary">
            Change</button>
        </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(5) a").addClass('active');
        });

        function makePass(length) {
          var result = '';
          var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
              charactersLength));

          }
          var passInput = document.getElementById('passInput');
          var passInput2 = document.getElementById('passInput2');
          passInput.value = result;
          passInput2.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e) {
          e.preventDefault();
          makePass(4);
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