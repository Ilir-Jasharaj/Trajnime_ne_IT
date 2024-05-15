<?php

	// connect with database
	$conn = new PDO("mysql:host=localhost;port=3306;dbname=sms_db", "root", "");

	// check if insert form is submitted
	if (isset($_POST["submit"]))
	{
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

<!-- include bootstrap, font awesome and rich text library CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />

<!-- include jquer, bootstrap and rich text JS -->
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

<!-- layout for form to add FAQ -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<h1 class="text-center">Add FAQ</h1>

			<!-- for to add FAQ -->
			<form method="POST" action="add.php">

				<!-- question -->
				<div class="form-group">
					<label>Enter Question</label>
					<input type="text" name="question" class="form-control" required />
				</div>

				<!-- answer -->
				<div class="form-group">
					<label>Enter Answer</label>
					<textarea name="answer" id="answer" class="form-control" required></textarea>
				</div>

				<!-- submit button -->
				<input type="submit" name="submit" class="btn btn-info" value="Add FAQ" />
			</form>
		</div>
	</div>

	<!-- show all FAQs added -->
	<div class="row">
		<div class="offset-md-2 col-md-8">
			<table class="table table-bordered">
				<!-- table heading -->
				<thead>
					<tr>
						<th>ID</th>
						<th>Question</th>
						<th>Answer</th>
						<th>Actions</th>
					</tr>
				</thead>

				<!-- table body -->
				<tbody>
					<?php foreach ($faqs as $faq): ?>
						<tr>
							<td><?php echo $faq["id"]; ?></td>
							<td><?php echo $faq["question"]; ?></td>
							<td><?php echo $faq["answer"]; ?></td>
							<td>
								<!-- edit button -->
								<a href="edit.php?id=<?php echo $faq['id']; ?>" class="btn btn-warning btn-sm">
									Edit
								</a>

								<!-- delete form -->
								<form method="GET" action="delete1.php" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                <input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm" />
                                </form>

							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	// initialize rich text library
	window.addEventListener("load", function () {
		$("#answer").richText();
	});
</script>