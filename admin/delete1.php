<?php

// connect with the database
$conn = new PDO("mysql:host=localhost;port=3307;dbname=sms_db", "root", "");

// check if FAQ ID is provided
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // delete the FAQ with the provided ID
    $sql = "DELETE FROM faqs WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);

    // redirect back to the main page after deletion
    header("Location: indexfaq.php");
    exit();
}
