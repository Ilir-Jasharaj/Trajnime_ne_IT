<?php
session_start();
if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/subject.php";
        $courses = getAllSubjects($conn);

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Course</title>
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
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 20px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0, 0.1);
                }

                .container {
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 20px;
                }

                .btn-dark {
                    background-color: #343a40;
                    border-color: #343a40;
                }

                .table thead th {
                    background-color: #343a40;
                    color: #fff;
                }

                .n-table {
                    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                }

                .btn-add {
                    margin-bottom: 10px;
                    background-color: #212529;
                }

                .alert {
                    margin-top: 10px;
                }

                .table {
                    margin-top: 20px;
                }

                .w-450 {
                    width: 450px;
                }

                .mt-5 {
                    margin-top: 5rem;
                }

                .m-5 {
                    margin: 5rem;
                }

                .active {
                    color: #fff;
                }
            </style>
        </head>

        <body>
            <?php
            include "inc/navbar.php";
            if ($courses != 0) {
            ?>
                <div class="container-main mt-5">
                    <a href="course-add.php" class="btn btn-dark">Add New Course</a>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger mt-3 n-table" role="alert">
                            <?= $_GET['error'] ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-info mt-3 n-table" role="alert">
                            <?= $_GET['success'] ?>
                        </div>
                    <?php } ?>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 n-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($courses as $course) {
                                    $i++;  ?>
                                    <tr id="row-<?= $course['subject_id'] ?>">
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $course['subject'] ?></td>
                                        <td><?= $course['subject_code'] ?></td>
                                        <td>
                                            <a href="course-edit.php?course_id=<?= $course['subject_id'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="#" class="btn btn-danger btn-delete" data-course-id="<?= $course['subject_id'] ?>">Delete</a>
                                        </td>
                                    </tr>
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
                        $("#navLinks li:nth-child(7) a").addClass('active');
                        $('.btn-delete').on('click', function(e) {
                            e.preventDefault();
                            var courseId = $(this).data('course-id');
                            deleteCourse(courseId);
                        });

                        function deleteCourse(courseId) {
                            if (confirm("Are you sure you want to delete this course?")) {
                                $.ajax({
                                    url: 'course-delete.php',
                                    method: 'POST',
                                    data: {
                                        course_id: courseId
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            alert(response.message);
                                            $('#row-' + courseId).remove();
                                        } else {
                                            alert(response.message);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.log(xhr.responseText);
                                        alert('An error occurred while deleting the course. Please try again.');
                                    }
                                });
                            }
                        }
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
<?php } else {
        header("Location: course.php");
        exit;
    }
} else {
    header("Location: course.php");
    exit;
}
?>