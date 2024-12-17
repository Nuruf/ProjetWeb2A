<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\projet web\vendor\autoload.php'; // Load Composer's autoloader

// Start output buffering
ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the input
    $id_reclamation = intval($_POST['id_reclamation']);
    $answer = trim($_POST['contenu']);

    if (!empty($id_reclamation) && !empty($answer)) {
        // Initialize the ReclamationController
        $reclamationController = new ReclamationController();

        // Call the method to add the answer (assuming your method is 'addAnswer')
        $success = $reclamationController->addAnswer($id_reclamation, $answer);

        if ($success) {
            // Fetch the user's email (ensure this comes from the reclamation object)
            $reclamation = $reclamationController->getReclamationById($id_reclamation);
            $userEmail = 'zayaneyassine6@gmail.com'; // You should fetch this from the $reclamation if available

            // Create PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // SMTP Server settings
                $mail->SMTPDebug = 0; // Turn off debugging to prevent output to the browser
                $mail->isSMTP();  // Use SMTP
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'jalloulaziz6@gmail.com'; // Your admin email
                $mail->Password = 'qfrr ouqw gizu tbrh'; // Application-specific password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipient and Sender settings
                $mail->setFrom('jalloulaziz6@gmail.com', 'Admin');
                $mail->addAddress($userEmail); // Recipient's email

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Your Reclamation Has Been Answered';
                $mail->Body = "Dear user,<br><br>We have received and answered your reclamation.<br><strong>Admin's Answer:</strong><br>" . nl2br(htmlspecialchars($answer)) . "<br><br>Regards,<br>Admin";
                $mail->AltBody = 'Dear user, your reclamation has been answered. Admin Answer: ' . $answer;

                // Send the email
                if ($mail->send()) {
                    // Do not echo here, instead handle the redirection first
                } else {
                    echo 'Mailer Error: Email could not be sent.';
                }

                // Now that the email was sent, redirect to the reclamation list page
                ob_end_clean(); // Clean the output buffer to prevent premature output
                header("Location: reclamationlistadmin.php");
                exit(); // Make sure to call exit to stop further code execution

            } catch (Exception $e) {
                echo "Mailer Error: {$mail->ErrorInfo}";
            }

        } else {
            echo "Failed to save the answer.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
