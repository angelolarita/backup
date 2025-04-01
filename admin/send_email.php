<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';
include(__DIR__ . "/../includes/db_connect.php");

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jelojohndanseco@gmail.com';
        $mail->Password = 'mknd ezzy epuo dozf'; // Use an app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('jelojohndanseco@gmail.com', 'ACTS Alumni Tracer');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Verification Approved - Proceed to Next Step';
        $mail->Body = "
            <p>Congratulations! Your verification request has been approved.</p>
            <p>Please proceed to the next step by clicking the link below:</p>
            <p><a href='http://localhost/Caps/geninfo.php' style='background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Continue to Next Form</a></p>
            <p>If the button does not work, copy and paste the following URL into your browser:</p>
            <p>http://localhost/Caps/geninfo.php</p>
            <br>
            <p>Thank you,<br>ACTS Alumni Tracer</p>";

        $mail->send();
        echo "Email sent successfully!";
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
}
?>