<?php

require_once '../functions/mail.php';

if (isset($_POST['enviar_email'])) {
    $email = $_POST["email"] ?? "";
    $nome = $_POST["nome"] ?? "";
    $fone = $_POST["fone"] ?? "";
    $assunto = $_POST["assunto"] ?? "";
    $mensagem = $_POST["mensagem"] ?? "";

    if (!empty($email) && !empty($nome) && !empty($fone) && !empty($assunto) && !empty($mensagem)) {
        $corpo = "
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css?family=Quicksand&display=swap' rel='stylesheet'>
            
            <div id='backEmail' style='width: 100%; height: 100%; background-color: #f8f8f8;  background-size:100%;'>
                <center><br><br>
                    <div id='corpo' style='width: 90%; height: 100%; background-color: #FFFFFF; border: 1px solid #eaeaea;'>
                        <!--#449c50-->
                        <div id='logo'>
                            <img src='https://64.media.tumblr.com/89881deeb856108db44eaeac3ec91d70/545fe8a6b692c9de-29/s2048x3072/9c637e526b085b917f8fa050c8173b07ee0a92e4.png' style='width: 13%; margin-top: 25px;' id='marca'>
                        </div><br>
                        
                            <div style='background-color: #0077c3; height: 50px;'>
                                <div id='tituloEmail' style='color: white; font-family: Quicksand, sans-serif; 
                                font-size: 16pt; padding-top: 9px;'>
                                    Nova mensagem do site
                                </div>
                            </div>
                            <br>
                                <div id='tituloEmail' style='color: #3a3938; font-family: Quicksand, sans-serif; 
                                font-size: 18pt;'>
                                    Dados do cliente:
                                </div>				
            
                                <div id='textoEmail' style='font-family: Roboto, sans-serif; color: #3a3938; 
                                text-align: left; width: 80%; margin-top: 20px; margin-bottom: 22px; font-size: 112%;'>
                                    <b>Nome: </b>" . $nome . " <br>
                                    <b>Whatsapp: </b> " . $fone . "<br>
                                    <b>Email: </b> " . $email . " <br>
                                    <b>Mensagem: </b> " . $mensagem . "<br>
                                </div><br>		
                    </div>
                </center><br><br>
            </div>    
        ";

        if (smtpmailer($assunto, $corpo)) {
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
            "resposta" => "Preencha todos os campo!"
        ];
    }

    echo json_encode($retorno);
}

if (isset($_POST['solicitar_orcamento'])) {
    $nome = $_POST["nome"] ?? "";
    $fone = $_POST["fone"] ?? "";
    $assunto = "Solicitação de Orçamento";

    
    if (!empty($nome) && !empty($fone)) {    
        $corpo = "
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css?family=Quicksand&display=swap' rel='stylesheet'>
            
            <div id='backEmail' style='width: 100%; height: 100%; background-color: #f8f8f8;  background-size:100%;'>
                <center><br><br>
                    <div id='corpo' style='width: 90%; height: 100%; background-color: #FFFFFF; border: 1px solid #eaeaea;'>
                        <!--#449c50-->
                        <div id='logo'>
                            <img src='https://64.media.tumblr.com/89881deeb856108db44eaeac3ec91d70/545fe8a6b692c9de-29/s2048x3072/9c637e526b085b917f8fa050c8173b07ee0a92e4.png' style='width: 13%; margin-top: 25px;' id='marca'>
                        </div><br>
                        
                            <div style='background-color: #0077c3; height: 50px;'>
                                <div id='tituloEmail' style='color: white; font-family: Quicksand, sans-serif; 
                                font-size: 16pt; padding-top: 9px;'>
                                    Solicitação de Orçamento
                                </div>
                            </div>
                            <br>
                                <div id='tituloEmail' style='color: #3a3938; font-family: Quicksand, sans-serif; 
                                font-size: 18pt;'>
                                    Dados do cliente:
                                </div>				
            
                                <div id='textoEmail' style='font-family: Roboto, sans-serif; color: #3a3938; 
                                text-align: left; width: 80%; margin-top: 20px; margin-bottom: 22px; font-size: 112%;'>
                                    <b>Nome: </b>" . $nome . " <br>
                                    <b>Whatsapp: </b> " . $fone . "<br>
                    </div>
                </center><br><br>
            </div>    
        ";

        if (smtpmailer($assunto, $corpo)) {
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
            "resposta" => "Preencha todos os campo!"
        ];
    }

    echo json_encode($retorno);
}
