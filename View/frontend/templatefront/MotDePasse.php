<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../config/config.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_Reset'])) {
    $email = trim($_POST['reset_email']);
    if (empty($email)) {
        $message = "Veuillez entrer une adresse email valide.";
        $messageType = 'danger';
    } else {
        // Vérification de l'email dans la base de données
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $password = $user['MotDePasse']; // Récupérer le mot de passe utilisateur

            // Configurer PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Paramètres du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'aziz.akrout07@gmail.com';
                $mail->Password = 'aziz@2004'; // Assurez-vous que votre mot de passe est correct
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Paramètres de l'email
                $mail->setFrom('aziz.akrout07@gmail.com', 'Dev Pathway');
                $mail->addAddress($email);

                // Contenu du mail
                $mail->isHTML(true);
                $mail->Subject = 'Récupération de votre mot de passe';
                $mail->Body = "<p>Bonjour,</p>
                               <p>Voici votre mot de passe pour accéder à votre compte : <strong>$password</strong></p>
                               <p>Merci de le garder confidentiel.</p>
                               <p>Cordialement,</p>";
                $mail->AltBody = "Bonjour,\n\nVoici votre mot de passe : $password\n\nMerci de le garder confidentiel.\n\nCordialement, L'équipe de support";

                $mail->send();
                $message = "Un email contenant votre mot de passe a été envoyé avec succès.";
                $messageType = 'success';
            } catch (Exception $e) {
                $message = "Une erreur est survenue lors de l'envoi de l'email : " . $mail->ErrorInfo;
                $messageType = 'danger';
            }
        } else {
            $message = "L'adresse email n'existe pas dans notre base de données.";
            $messageType = 'danger';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Mot de passe oublié</title>
</head>

<body>
    <div class="untree_co-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-5 mx-auto order-1" data-aos="fade-up" data-aos-delay="200">
                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-<?= htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php } ?>

                    <form class="form-box" method="POST">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="email">Entrez votre email pour recevoir un lien de réinitialisation du mot de passe :</label>

                                <input type="email" class="form-control" name="reset_email" id="resetEmail" class="form-control" placeholder="Entrez votre email">

                                <p id="errorMessageEmail" style="color: red;"></p>
                            </div>

                            <div class="col-12">
                                <input type="submit" name="submit_Reset" value="Envoyer le lien" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
















        const emailInput = document.getElementById('resetEmail');
        const errorMessage = document.getElementById('errorMessageEmail');

        emailInput.addEventListener('input', function() {
            if (emailInput.value === '') {
                errorMessage.textContent = 'Ce champ ne peut pas être vide';
            } else {
                errorMessage.textContent = '';
            }
        });


     



    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
