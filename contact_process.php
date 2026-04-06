<?php
// Contact form email configuration
$to = "rockybd1995@gmail.com";
$from = $_REQUEST['email'] ?? '';
$name = $_REQUEST['name'] ?? '';
$subject = $_REQUEST['subject'] ?? 'Contact Form Message';
$number = $_REQUEST['number'] ?? '';
$cmessage = $_REQUEST['message'] ?? '';

// Email headers
$headers = "From: $from";
$headers .= "\r\nReply-To: " . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// Email subject
$email_subject = "ShopPhee Contact Form - New Message from " . $name;

// Create HTML email body
$body = "<html><body>";
$body .= "<h2>You have received a message from your contact form</h2>";
$body .= "<table style='width: 100%;'>";
$body .= "<tr><td><strong>Name:</strong></td><td>" . htmlspecialchars($name) . "</td></tr>";
$body .= "<tr><td><strong>Email:</strong></td><td>" . htmlspecialchars($from) . "</td></tr>";
if (!empty($number)) {
    $body .= "<tr><td><strong>Phone:</strong></td><td>" . htmlspecialchars($number) . "</td></tr>";
}
$body .= "<tr><td><strong>Message:</strong></td><td>" . nl2br(htmlspecialchars($cmessage)) . "</td></tr>";
$body .= "</table>";
$body .= "</body></html>";

// Send email
$email_sent = mail($to, $email_subject, $body, $headers);

// Return response
header('Content-Type: application/json');
if ($email_sent) {
    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'There was an error sending your message. Please try again later.']);
}
?>
