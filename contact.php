<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data from the HTML form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);
    $interest = isset($_POST['interest']) ? $_POST['interest'] : '';

    // Validate form fields
    if (empty($name) || empty($email) || empty($phone) || empty($message) || empty($interest)) {
        echo json_encode(["status" => "error", "message" => "Please fill out all fields."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit;
    }

    // Prepare email
    $to = "guptainfotech999@gmail.com"; // Your email address
    $subject = "Enquiry to GUPTA INFO TECH";
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Interest: $interest\n";
    $body .= "Message:\n$message\n";
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Your message has been sent successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send your message. Try again later."]);
    }
}
?>
