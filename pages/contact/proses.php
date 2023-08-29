<?php
// Llamar database.php para conexión de base de datos
require_once "../../config/database.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

if (isset($_POST['send'])) {
    // captura de datos desde un formulario para presentar resultados
    $name    = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    $email   = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    $message = mysqli_real_escape_string($mysqli, trim($_POST['message']));

    // consultar comando para guardar los datos en un mensaje
    $query = mysqli_query($mysqli, "INSERT INTO is_message(name,email,message)
                                    VALUES('$name','$email','$message')")
                                    or die('Hubo un error en la consulta de registro : '.mysqli_error($mysqli));    

    // comprobar consulta
    if ($query) {
        $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'leonardo14bf@hotmail.com';                     //SMTP username
        $mail->Password   = 'pokemon14';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('leonardo14bf@hotmail.com', 'Soluciones en sistemas');
        $mail->addAddress("$email", 'Cliente');     //Add a recipient

        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/v    ar/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Gracias por contactarnos';
        $mail->Body    = 'Recibimos tu mensaje satifactoriamente';
        $mail->AltBody = 'Tomaremos en cuenta tu mensaje, hablanos pronto";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
        
        header("location: ../../contact-success");
    }  

    
}   
?>