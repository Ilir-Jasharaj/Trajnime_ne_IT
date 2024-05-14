<?php

// connect with database
$conn = new PDO("mysql:host=localhost:3307;dbname=sms_db", "root", "");

// fetch all FAQs from database
$sql = "SELECT * FROM faqs";
$statement = $conn->prepare($sql);
$statement->execute();
$faqs = $statement->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>
    <title>FAQ Questions and Answers</title>

    <!-- include CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../admin/font-awesome/css/font-awesome.css">

    <!-- apply custom styles -->
    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            margin-top: 50px;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .container h2 {
            padding: 20px;
            margin: 0;
            background-color: #f9f9f9;
            font-size: 24px;
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
        }

        .panel {
            border: none;
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 0;
        }

        .panel-heading {
            padding: 0;
        }

        .panel-title a {
            display: block;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
            border-bottom: 1px solid #e5e5e5;
            position: relative;
            font-size: 18px;
            line-height: 24px;
            text-decoration: none;
        }

        .panel-title a:before {
            content: "\f107";
            font-family: 'FontAwesome';
            font-size: 18px;
            line-height: 24px;
            position: absolute;
            top: 20px;
            right: 20px;
            transition: transform 0.3s;
        }

        .panel-title a.collapsed:before {
            transform: rotate(45deg);
        }

        .panel-body {
            border-top: 1px solid #e5e5e5;
            padding: 30px;
            background-color: #fff;
            color: #555;
        }

        .panel-body p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <?php
    include "inc/navbar.php";
    ?>

    <div class="container">
        <h2>FAQ Questions and Answers</h2>
        <div class="panel-group" id="accordion_one">
            <?php foreach ($faqs as $faq) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion_one" href="#faq-<?php echo $faq['id']; ?>" aria-expanded="false" class="collapsed">
                                <?php echo $faq['question']; ?>
                            </a>
                        </h4>
                    </div>
                    <div id="faq-<?php echo $faq['id']; ?>" class="panel-collapse collapse" aria-expanded="false">
                        <div class="panel-body">
                            <div class="text-accordion">
                                <?php echo $faq['answer']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- include JS -->
    <script src="../admin/js/jquery-3.3.1.min.js"></script>
    <script src="../admin/js/bootstrap.js"></script>
</body>

</html>