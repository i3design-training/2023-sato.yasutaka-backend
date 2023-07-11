<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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

      // データベースに新しいユーザーを作成する処理を実行する
      $user = new User();
      $user->username = $username;
      $user->email = $email;
      $user->password = $password;
      $user->save();

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

      // Email VerificationテーブルにIDとトークンを保存する処理
      // $user = User::find($request->getQueryParams()['user_id']);
      $emailVerification = new EmailVerifications();
      $verificationToken = bin2hex(random_bytes(16)); // トークンを生成
      $emailVerification->user_id = $user->id;
      $emailVerification->token = $verificationToken;
      $emailVerification->save();

      // 成功レスポンスを返す
      $response->getBody()->write('User created successfully');
      return $response->withStatus(200);
    }

    private function saveUserToDatabase($email, $password,$username)
    {
      $user = new User();
      $user->id = uniqid(); 
      $user->username = $username;
      $user->email = $email;
      $user->password = $password;
      $user->save();
    }
}