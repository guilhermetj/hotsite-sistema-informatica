<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $mail_to = "c.lucasrodrigues22@gmail.com";
        
        $subject = trim($_POST["subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
            http_response_code(400);
            echo "Por favor, complete o formulário e tente novamente.";
            exit;
        }
        
        $content = "Name: $name\n";
        $content .= "Email: $email\n\n";
        $content .= "Message:\n$message\n";

        $headers = "From: $name <$email>";

        $success = mail($mail_to, $subject, $content, $headers);
        if ($success) {
            http_response_code(200);
            echo "Obrigado, sua mensagem foi enviada com sucesso.";
        } else {
            http_response_code(500);
            echo "Oops! Alguma coisa deu errado, não podemos enviasr sua mensagem.";
        }

    } else {
        http_response_code(403);
        echo "Ocorreu um problema no seu envio. Tente novamente.";
    }

?>
