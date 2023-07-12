<?php

namespace App\Action;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSendAction
{
    public function sendEmail($to, $subject, $body)
    {
        // PHPMailerのインスタンスを作成
        $mail = new PHPMailer(true);

        try {
            // SMTP設定
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'sato.yasutaka@i3design.co.jp';
            $mail->Password = 'jkrkeeikpttvqrka';
            $mail->SMTPSecure = 'tls';

            // 送信元と宛先を設定
            $mail->setFrom('sato.yasutaka@i3design.co.jp', 'ToDoApp');
            $mail->addAddress($to);

            // メールの内容を設定
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // メールを送信
            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
