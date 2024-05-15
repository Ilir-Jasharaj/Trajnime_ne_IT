<?php

$conn = new PDO("mysql:host=localhost;port=3306;dbname=sms_db", "root", "");

// check if insert form is submitted
if (isset($_POST["submit"])) {
    // create table if not already created
    $sql = "CREATE TABLE IF NOT EXISTS faqs (
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        question TEXT NULL,
        answer TEXT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $statement = $conn->prepare($sql);
    $statement->execute();

    // insert in faqs table
    $sql = "INSERT INTO faqs (question, answer) VALUES (?, ?)";
    $statement = $conn->prepare($sql);
    $statement->execute([
        $_POST["question"],
        $_POST["answer"]
    ]);
}

// get all faqs from latest to oldest
$sql = "SELECT * FROM faqs ORDER BY id DESC";
$statement = $conn->prepare($sql);
$statement->execute();
$faqs = $statement->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../Logo 1_a v5.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />
    <link rel="stylesheet" type="../css/footer.css">

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="richtext/jquery.richtext.js"></script>
    <style>
        .container-main {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: 0 auto;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f7f7f7;
            text-align: left;
            font-weight: bold;
        }

        .btn-warning,
        .btn-danger {
            color: #fff;
            margin-right: 5px;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
        }
    </style>

</head>

<body>
    <?php
    include "inc/navbar.php";
    ?>

    <div class="container-main" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <h1 class="text-center">Add FAQ</h1>

                <form method="POST" action="add.php">
                    <div class="form-group">
                        <label>Enter Question</label>
                        <input type="text" name="question" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Enter Answer</label>
                        <textarea name="answer" id="answer" class="form-control" required></textarea>
                    </div>

                    <input type="submit" name="submit" class="btn btn-info" value="Add FAQ" />
                </form>
            </div>
        </div>

        <div class="row">
            <div class="offset-md-2 col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($faqs as $faq) : ?>
                            <tr>
                                <td><?php echo $faq["id"]; ?></td>
                                <td><?php echo $faq["question"]; ?></td>
                                <td><?php echo $faq["answer"]; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $faq['id']; ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="delete.php?id=<?php echo $faq['id']; ?>" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    <script>
        $(document).ready(function() {
            $("#navLinks li:nth-child(9) a").addClass('active');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#answer').richText();
        });
    </script>
</body>


</html>