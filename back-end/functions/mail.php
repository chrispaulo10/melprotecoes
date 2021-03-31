<?php
header('Content-Type: text/html; charset=utf-8');

/* Extender a classe do phpmailer para envio do email*/
require_once("phpmailer/class.phpmailer.php");

/* Definir Usuário e Senha do Hmail de onde partirá os emails*/
define('GUSER', 'contato@redesdeprotecoes.com.br');
define('GPWD', "ZUxJx:yQ1");

function smtpmailer($email, $nome, $fone, $assunto, $mensagem)
{
	$mail = new PHPMailer();

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
                
                    <div style='background-color: #cc4848; height: 50px;'>
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
                            <b>Nome: </b>".$nome." <br>
                            <b>Email: </b> ".$email." <br>
                            <b>Número: </b> ".$fone." <br>
                            <b>Mensagem: </b> " . $mensagem ."<br>
                        </div><br>		
            </div>
        </center><br><br>
    </div>    
    ";
	

	/* Montando o Email*/
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP(); /* Ativar SMTP*/
	$mail->SMTPDebug = 1; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
	$mail->SMTPAuth = true; /* Autenticação ativada */
	$mail->SMTPSecure = 'ssl'; /* TLS REQUERIDO pelo GMail*/
	$mail->Host = 'smtp.hostinger.com'; /* SMTP utilizado*/
	$mail->Port = 465; /* A porta 465 deverá estar aberta em seu servidor*/
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom('contato@redesdeprotecoes.com.br', 'Mel Proteções');
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress('atendimento@redesdeprotecoes.com.br');
	$mail->IsHTML(true);

	/* Função Responsável por Enviar o Email*/
	if (!$mail->Send()) {
		return false;
	} else {
		return true;
	}
}