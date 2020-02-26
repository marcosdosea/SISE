<?php

require 'phpmailer/PHPMailerAutoload.php';

function enviarEmail($mensagem, $destinatario) {

        define('GUSER', 'sistema.sise@outlook.com'); // <-- Insira aqui o seu email
        define('GPWD', 's1s3it@t3chjr');  // <-- Insira aqui a senha do seu email

        $mail = new PHPMailer();//
        $mail->CharSet = 'UTF-8';//
        $mail->SetLanguage("br");
        $mail->IsMail();
        $mail->IsSMTP();  // Ativar SMTP
        $mail->SMTPDebug = 0;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;  // Autenticação ativada
        $mail->SMTPSecure = 'STARTTLS'; // SSL REQUERIDO pelo hotmail
        $mail->Host = 'smtp-mail.outlook.com'; // SMTP utilizado
        $mail->Port = 587;    // A porta 465 deverá estar aberta em seu servidor
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SetFrom(GUSER, "Contato Sise");
        $mail->Subject = 'Mensagem Enviada pelo SISE'; //nome de quem ta enviando, vai aparecer na coluna "De:"

        //$mail->isHTML(true);
        $mail->MsgHTML($mensagem);
        $mail->AddAddress($destinatario); //QUEM VAI RECEBER


    if ($mail->Send()) return true; else {
        //GRAVAR ALGUM LOG DE ERRO DE EMAIL
        return false;
    }


}

?>