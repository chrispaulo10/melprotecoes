<?php
    
    require_once '../functions/mail.php'; 

    if (isset($_POST['enviar_email'])) {
        $email = $_POST["email"] ?? "";
        $nome = $_POST["nome"] ?? "";
        $assunto = $_POST["assunto"] ?? "";
        $mensagem = $_POST["mensagem"] ?? "";

        if ( !(empty($email) && empty($nome) && empty($assunto) && empty($mensagem)) ) {
        
            if (smtpmailer($email, $nome, $assunto, $mensagem)) {
                $retorno = [ "success" => "Email Enviado!" ];
            } else {
                $retorno = [ "danger" => "Não foi possível envial o email!" ];
            }

        }

        echo json_encode($retorno);
    }