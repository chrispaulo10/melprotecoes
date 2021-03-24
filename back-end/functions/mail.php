<?php
header('Content-Type: text/html; charset=utf-8');

/* Extender a classe do phpmailer para envio do email*/
require_once("phpmailer/class.phpmailer.php");

/* Definir Usuário e Senha do Gmail de onde partirá os emails*/
define('GUSER', 'recuperar_senha@wrinfoteam.com.br');
define('GPWD', "ZUxJx:yQ");

function smtpmailer($para, $nome, $assunto, $mensagem)
{
	$mail = new PHPMailer();

    $corpo = "<!DOCTYPE html>
                    <html lang='pt-br'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Document</title>
                            <link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&display=swap' rel='stylesheet'>
                            <style>
                                .maior{
                                    height:500px;
                                    max-width:380px;
                                    background-color: white;
                                    border: 1px solid;  
                                    border-color:grey;
                                    border-radius: 10px;
                                    padding: 3%;
                                }
                                h1 {
                                    font-family: 'Roboto Condensed', sans-serif;
                                    font-size: 20px;
                                    margin-top: 5%;
                                    color: rgb(49, 49, 49);
                                }
                                p{
                                    font-family: 'Roboto Condensed', sans-serif;
                                    font-size: 16px;
                                    margin-top: 5%;
                                    text-decoration: none;
                                    color: rgb(83, 83, 83);
                                }
                                p.sm {
                                    margin-top: 50px;
                                    font-size: 14px; 
                                }
                                .ml{
                                    margin-left: 10px;
                                }
                                .mr{
                                    margin-right:10px;
                                }
                                .mb{
                                    margin-bottom: -15px;
                                }
                                .mt{
                                    margin-top: 25px;
                                }
                                .btn{
                                    font-size: 15px;
                                    height: 36px;
                                    width: 100px;
                                    color:white;
                                    background-color:#F34A4F;
                                    font-family: 'Roboto Condensed', sans-serif;
                                    border-radius: 5px;
                                    margin-top: 10px;
                                    border: none;
                                    transition:0.5s;
                                    outline:none;
                                    cursor:pointer;
                                }

                                .btn:hover{
                                    background-color:#d62f34;
                                    border: none;
                                    transition:0.5s;
                                    outline:none;
                                }
                                .img{
                                    margin-bottom:30px;
                                    margin-top:15px;
                                }
                                a {
                                    color: #F34A4F;
                                    text-decoration: none;
                                }
                                a:hover {
                                    color: #850206;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='maior'>
                                <div class='ml'>
                                    <img src='https://wrinfoteam.com.br/cooperfam/assets/images/email.png' alt='' class='img'>
                                    <h1>Bem-vindo, $nome</h1>  
                                    <p>Você está recebendo este e-mail porque foi cadastrado na plataforma Aprovando Mais.</p>
                                    <p>Clique no botão abaixo para acessar o sistema:</p>
                                    <a href='http://aprovandomais.wrinfoteam.com.br/'>
                                        <button class='btn'>Fazer&nbsp;Login</button>
                                    </a>
                                    <p class='sm'>
                                        Caso você tenha recebido esta mensagem por engano, solicite o cancelamento do seu cadastro clicando
                                        <a href='http://aprovandomais.wrinfoteam.com.br/views/pages/cancelar_conta/$para'>AQUI</a>.
                                    </p>
                                    <hr class='mr mt'>
                                    <p class='mb'>Att,</p>
                                    <p class='mb-2'>Equipe, <strong>Aprovando Mais.</strong></p>
                                </div>
                            </div>
                            
                        </body>
                    </html>
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
	$mail->SetFrom('recuperar_senha@wrinfoteam.com.br', 'Mel Proteções');
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	$mail->IsHTML(true);

	/* Função Responsável por Enviar o Email*/
	if (!$mail->Send()) {
		return false;
	} else {
		return true;
	}
}
