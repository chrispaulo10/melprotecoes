<?php
    
    require_once '../functions/mail.php'; 

    if (isset($_POST['enviar_email'])) {
        $email = $_POST["email"] ?? "";
        $nome = $_POST["nome"] ?? "";
        $fone = $_POST["fone"] ?? "";
        $assunto = $_POST["assunto"] ?? "";
        $mensagem = $_POST["mensagem"] ?? "";

        if ( !(empty($email) && empty($nome) && empty($fone) && empty($assunto) && empty($mensagem)) ) {
        
            if (smtpmailer($email, $nome, $fone, $assunto, $mensagem)) {
                $retorno = [
                    "tipo" => "success",
                    "resposta" => "Email Enviado!"
                ];
            } else {
                $retorno = [
                    "tipo" => "danger",
                    "resposta" => "Não foi possível envial o email!"
                ];
            }

        } else {
            $retorno = [ 
                "tipo" => "warning",
                "resposta" => "Preencha todos os campo!" ];
        }

        echo json_encode($retorno);
    }