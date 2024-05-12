<?php

	$conn = new PDO("mysql:host=localhost;port=3307;dbname=sms_db", "root", "");

	$sql = "SELECT * FROM faqs WHERE id = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([
		$_REQUEST["id"]
	]);
	$faq = $statement->fetch();

	if (!$faq)
	{
		die("FAQ not found");
	}

	if (isset($_POST["submit"]))
	{
		$sql = "UPDATE faqs SET question = ?, answer = ? WHERE id = ?";
		$statement = $conn->prepare($sql);
		$statement->execute([
			$_POST["question"],
			$_POST["answer"],
			$_POST["id"]
		]);

		// redirect back to previous page
		header("Location:indexfaq.php ");
	}

?>

<!-- include CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />


<!-- include JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>
<style>
    body{
        background-color: #f5f5f5;
    }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
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
            background-color: #f5f5f5;
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

<!-- layout for form to edit FAQ -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<h1 class="text-center">Edit FAQ</h1>

			<!-- form to edit FAQ -->
			<form method="POST" action="edit.php">

				<!-- hidden ID field of FAQ -->
				<input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />

				<!-- question, auto-populate -->
				<div class="form-group">
					<label>Enter Question</label>
					<input type="text" name="question" class="form-control" value="<?php echo $faq['question']; ?>" required />
				</div>

				<!-- answer, auto-populate -->
				<div class="form-group">
					<label>Enter Answer</label>
					<textarea name="answer" id="answer" class="form-control" required><?php echo $faq['answer']; ?></textarea>
				</div>

				<!-- submit button -->
				<input type="submit" name="submit" class="btn btn-warning" value="Edit FAQ" />
				<button><a href="indexfaq.php" class="btn ">Go Back</a></button>
			</form>
		</div>
	</div>
</div>

<script>
	// initialize rich text library
	window.addEventListener("load", function () {
		$("#answer").richText();
	});
</script>