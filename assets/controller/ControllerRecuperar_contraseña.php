<?php
// Incluir el archivo autoload de Composer
require '../../vendor/autoload.php';
include ("../../loginphp/conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ensure the email field is set
if (isset($_POST['email'])) {
    $email = $_POST['email'];
   
    // Query to check if the email exists in the database
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resul = $stmt->get_result();
    $row = $resul->fetch_assoc();
    $te =$row['id'];

    $url='http://localhost/xampp/Epceicotol/Epceicotol/loginphp/restablecer.php?id='.$te;
    if ($resul->num_rows > 0) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sebdyjxjig@gmail.com';
            $mail->Password = 'yehqmblvhwdshhai';  // Consider using a secure method to handle passwords
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('sebdyjxjig@gmail.com', 'Juan');
            $mail->addAddress($email, 'Sebastian');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "Haz clic en el siguiente enlace para restablecer tu contraseña: <a href='$url'>Restablecer contraseña</a>";

            $mail->send();
            echo "<script>
                alert('CORREO ENVIADO CORRECTAMENTE');
                window.location='../../loginphp/loginAprendiz.php';
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Error al enviar el correo electrónico: {$mail->ErrorInfo}');
                window.location='../../loginphp/loginAprendiz.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Correo no encontrado');
            window.location='../../loginphp/loginAprendiz.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Por favor ingrese un correo electrónico');
        window.location='../../loginphp/loginAprendiz.php';
    </script>";
}
?>
