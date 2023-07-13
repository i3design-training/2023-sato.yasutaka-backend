<?php
namespace App\Action;

use App\Model\User;
use App\Model\Token;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginCheckAction
{
  public function __invoke(Request $request, Response $response): Response
  {
    $requestBody = $request->getBody()->getContents();
    $decodedRequestBody = json_decode($requestBody);
    $email = $decodedRequestBody->email; 
    $password = $decodedRequestBody->password; 
    $user = User::where('email', $email)->first();
    $loginSuccessful = ($user && $password === $user->password);

    if ($loginSuccessful) {
      // トークンの生成
      $token = $this->generateToken();

      // tokensDB への保存
      $tokenRecord = new Token();
      $tokenRecord->user_id = $user->id;
      $tokenRecord->token = $token;
      $tokenRecord->save();

      // トークンをレスポンスに含めて返す
      $responseData = [
        'token' => $token,
        'message' => 'Login verification successful',
      ];
      $response->getBody()->write(json_encode($responseData));
      return $response->withStatus(200);
    } else {
      $response->getBody()->write("Login verification failed");
      return $response->withStatus(400);
    }
  }
    // トークンの生成メソッド
    private function generateToken()
    {
      $token = bin2hex(random_bytes(16));
      return $token;
    }
}
