<?php
$date = new DateTime("now", new DateTimeZone('Asia/Calcutta'));

// Decode JSON data from frontend
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo "Error: Invalid data format";
    exit;
}

// Extract and sanitize fields
$fullname     = htmlspecialchars($data['fullname']);
$email        = htmlspecialchars($data['email']);
$company      = htmlspecialchars($data['company']);
$enquiryType  = htmlspecialchars($data['enquiryType']);
$messageText  = nl2br(htmlspecialchars($data['message']));
$sendCopy     = isset($data['sendCopy']) && $data['sendCopy'] ? "Yes" : "No";

// Email setup
$to = "nandantherapeuticss@gmail.com";
$email_subject = "New Patient Enquiry - " . $date->format('d-m-Y H:i:s');

// Email body with style
$email_body = "
<html>
<head>
    <title>New Enquiry Received</title>
</head>
<body style='font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;'>
    <div style='max-width: 600px; background: #fff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); margin:0 auto; border:1px solid #0199aa;'>
        <div style='color: #fff; text-align: center; padding: 15px; font-size: 20px; border-radius: 6px 6px 0 0; background: #0199aa;'>
            New Enquiry Submission
        </div>
        <div style='padding: 20px;'>
            <table style='width: 100%; border-collapse: collapse; border: 1px solid #e9e9e9;'>
                <tbody>
                    <tr>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>Full Name</td>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px; font-weight: 600;'>$fullname</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>Email</td>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px; font-weight: 600;'>$email</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>Company</td>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px; font-weight: 600;'>$company</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>Enquiry Type</td>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px; font-weight: 600;'>$enquiryType</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>Message</td>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>$messageText</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>Send Copy to Patient</td>
                        <td style='border: 1px solid #e9e9e9; padding: 8px 12px;'>$sendCopy</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style='text-align: center; color: #666; font-size: 14px; padding-bottom: 15px;'>
            Submitted from the website enquiry form.
        </div>
    </div>
</body>
</html>
";

// Email headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "Reply-To: $email\r\n";

// Send the email
if (mail($to, $email_subject, $email_body, $headers)) {
    echo "Success: Enquiry sent successfully!";
} else {
    echo "Error: Failed to send email.";
}
?>
