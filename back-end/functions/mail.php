<?php
header('Content-Type: text/html; charset=utf-8');

/* Extender a classe do phpmailer para envio do email*/
require_once("phpmailer/class.phpmailer.php");

/* Definir Usuário e Senha do Hmail de onde partirá os emails*/
define('GUSER', 'contato@redesdeprotecoes.com.br');
define('GPWD', "ZUxJx:yQ1");

function smtpmailer($assunto, $corpo)
{
	$mail = new PHPMailer();	

	/* Montando o Email*/
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP(); /* Ativar SMTP*/
	$mail->SMTPDebug = 0; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
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