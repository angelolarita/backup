<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Load PHPMailer from vendor

require '../includes/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user's email
    $query = "SELECT email FROM verification_requests WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $email = $user['email'];

        // Approve request in the database
        $updateQuery = "UPDATE verification_requests SET status = 'approved' WHERE id = :id";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            
            // Send approval email
            $mail = new PHPMailer(true);
            try {
                // SMTP settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jelojohndanseco@gmail.com'; // Replace with your Gmail
                $mail->Password = 'mknd ezzy epuo dozf'; // Replace with your App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Email details
                $mail->setFrom('jelojohndanseco@gmail.com', 'ACTS Alumni Tracer');
                $mail->addAddress($email);
                $mail->Subject = 'Verification Approved';
                $mail->isHTML(true);
                $mail->Body = "
                    <h2>Congratulations!</h2>
                    <p>Your verification request has been approved.</p>
                    <p>Click the link below to continue filling out your details:</p>
                    <p><a href='http://localhost/Caps/geninfo.php'>Continue Registration</a></p>
                    <br>
                    <p>Thank you!</p>
                ";

                if ($mail->send()) {
                    echo "<script>alert('Request Approved & Email Sent!'); window.location.href='verification_request.php';</script>";
                } else {
                    echo "<script>alert('Approval Success but Email Failed!'); window.location.href='verification_request.php';</script>";
                }
            } catch (Exception $e) {
                echo "<script>alert('Approval Success but Email Error: " . $mail->ErrorInfo . "'); window.location.href='verification_request.php';</script>";
            }
        } else {
            echo "<script>alert('Approval Failed!'); window.location.href='verification_request.php';</script>";
        }
    } else {
        echo "<script>alert('User Not Found!'); window.location.href='verification_request.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request!'); window.location.href='verification_request.php';</script>";
}
?>