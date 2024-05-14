<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the question data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $question = $_POST['question'];
    
    // Store the question in the database (Assuming you have a function to save the question in the database)
    saveQuestion($name, $email, $question);
    
    // Redirect back to the FAQ page after submitting the question
    header('Location: index.php');
    exit();
}
