<?php
session_start();
if (
  isset($_SESSION['admin_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Admin') {
    include "../DB_connection.php";
    include "data/message.php";
    $messages = getAllMessages($conn);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin - Messages</title>
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
          max-width: 1200px;
          margin: 0 auto;
          margin-bottom: 100px;
          padding: 2rem;
          background-color: #212529;
          border-radius: 8px;
          box-shadow: 0 30px 20px rgba(0, 0, 0, 0.1);
          color: white;
        }

        .container {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
        }

        .form-label {
          font-weight: 600;
          color: #4c51bf;
        }

        .form-control {
          width: 100%;
          padding: 1rem;
          font-size: 1rem;
          border-radius: 4px;
          border: 1px solid #d2d6dc;
        }

        .form-control:focus {
          outline: none;
          border-color: #4c51bf;
          box-shadow: 0 0 0 3px rgba(76, 81, 191, 0.1);
        }

        .btn-primary {
          display: inline-block;
          padding: 1rem;
          font-size: 1rem;
          font-weight: 600;
          color: #ffffff;
          background-color: #4c51bf;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
          background-color: #434190;
        }

        .alert {
          padding: 1rem;
          border-radius: 4px;
        }

        .alert-danger {
          color: #842029;
          background-color: #f8d7da;
          border-color: #f5c2c7;
        }

        .alert-success {
          color: #0f5132;
          background-color: #d1e7dd;
          border-color: #badbcc;
        }

        .alert hr {
          margin-top: 0.5rem;
          margin-bottom: 0.5rem;
          border: 0;
          border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
      </style>
    </head>

    <body>
      <?php
      include "inc/navbar.php";
      if ($messages != 0) {
      ?>
        <div class="container-main mt-5" style="width: 90%; max-width: 700px;">
          <h4 class="text-center p-3">Inbox</h4>
          <div class="accordion accordion-flush" id="accordionFlushExample_<?= $message['message_id'] ?>">
            <?php foreach ($messages as $message) { ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading_<?= $message['message_id'] ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse_<?= $message['message_id'] ?>" aria-expanded="false" aria-controls="flush-collapse_<?= $message['message_id'] ?>">
                    <?= $message['sender_full_name'] ?>

                  </button>
                </h2>
                <div id="flush-collapse_<?= $message['message_id'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading_<?= $message['message_id'] ?>" data-bs-parent="#accordionFlushExample_<?= $message['message_id'] ?>">
                  <div class="accordion-body">

                    <?= $message['message'] ?>

                    <div class="d-flex mb-3">
                      <div class="p-2">Email: <b><?= $message['sender_email'] ?></b></div>
                      <div class="ms-auto p-2">Date: <?= $message['date_time'] ?></div>
                    </div>

                  </div>
                </div>
              </div>
            <?php } ?>
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
            $("#navLinks li:nth-child(8) a").addClass('active');
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