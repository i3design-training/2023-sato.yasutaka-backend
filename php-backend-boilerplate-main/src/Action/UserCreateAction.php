<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Users; 


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
        // 以下は仮の実装です
        $user = new Users();
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        // 成功レスポンスを返す
        $response->getBody()->write('User created successfully');
        return $response->withStatus(200);
    }

    private function saveUserToDatabase($email, $password,$username)
    {
      $user = new Users();
      $user->id = uniqid(); 
      $user->username = $username;
      $user->email = $email;
      $user->password = $password;
      $user->save();
    }
}