<?php
$date = new DateTime("now", new DateTimeZone('Asia/Calcutta'));

// Email details
$to = "nandantherapeuticss@gmail.com";
$subject = "Join with Us - " . $date->format('d-m-Y H:i:s');
$message = "Hello! A visitor has shown interest in  Nandan Therapeutics and submitted a request.";

// People section
$message .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
$message .= "<tr style='background:#ccc'>
                <th style='text-align: left;'>First Name</th>
                <th style='text-align: left;'>Last Name</th>
                <th style='text-align: left;'>Email ID</th>
                <th style='text-align: left;'>Phone Number</th>
                <th style='text-align: left;'>Company Name</th>
                <th style='text-align: left;'>Country</th>
                <th style='text-align: left;'>Message</th>
                <th style='text-align: left;'>Subscribe</th>
            </tr>";
$message .= "<tr>";
$message .= "<td>" . htmlspecialchars($_POST['firstName']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['lastName']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['email']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['phone']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['company']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['country']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['message']) . "</td>";
$message .= "<td>" . htmlspecialchars($_POST['subscribe']) . "</td>";
$message .= "</tr>";
$message .= "</table>";



// Email headers
$header = "From: nandantherapeuticss@gmail.com\r\n";
$header .= "Cc:  nandantherapeuticss@gmail.com\r\n"; // Combine the two email addresses into one line
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=UTF-8\r\n";

// Send the email
$retval = mail($to, $subject, $message, $header);

// Check result and display a message
if ($retval == true) {
    echo "Thanks for showing interest.";
} else {
    echo "Email sending error. Please check your mail server configuration.";
    // Get detailed error if mail fails
    $error = error_get_last();
    echo "<br>Error details: " . $error['message'];
}
?>
