<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Action\EmailSendAction;
use App\Model\User;
use App\Model\EmailVerifications;

class UserCreateAction
{
  public function __invoke(Request $request, Response $response): Response
  {
    $requestBody = $request->getBody()->getContents();
    $decodedRequestBody = json_decode($requestBody);
    $username = $decodedRequestBody->username;
    $email = $decodedRequestBody->email;
    $password = $decodedRequestBody->password;

    // ユーザーDBに新規ユーザーを登録
    $user = new User();
    $user->username = $username;
    $user->email = $email;
    $user->password = $password;
    $user->save();

    //EmailVerificationDBにIDとトークンを登録
    $user = User::where("email", $email)->first(); //上記で登録したemailに一致する最初のユーザーレコードを取得
    $emailVerification = new EmailVerifications();
    $verificationToken = bin2hex(random_bytes(16));
    $emailVerification->user_id = $user->id;
    $emailVerification->token = $verificationToken;
    $emailVerification->save();

    //Email送信処理
    $emailSender = new EmailSendAction();
    $verificationUrl ="http://localhost:5173/users/complete/verify?token=" . $verificationToken;
    $to = "sato.yasutaka@i3design.co.jp";
    $subject = "Register";
    $body = "クリックしてメールアドレスを確認してください: <a href='{$verificationUrl}'>こちらをクリック</a>";

    $emailSender->sendEmail($to, $subject, $body);

    // 成功レスポンスを返す
    $response->getBody()->write("User created successfully");
    return $response->withStatus(200);
  }
}

//これは上手くいかなかった
// $user->emailVerification()->create(
//   [
//     'token' => bin2hex(random_bytes(16))
//   ]
//   );
// $emailVerification = $user->emailVerification();

// $user = User::create([
//   'username' => $username,
//   'email' => $email,
//   'password' => $password
// ]);
