<?php
namespace App\Action;

use App\Model\EmailVerifications;
use App\Model\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TokenCheckAction
{
  public function __invoke(Request $request, Response $response): Response
  {
    // フロントエンドからのトークンを取得
    $frontendToken = $request->getQueryParams()["token"];

    // EmailVerificationDBから対応するトークンを取得
    $emailVerification = EmailVerifications::where(
      "token",
      $frontendToken
    )->first();

    // if ($frontendToken) {
    if ($emailVerification) {
      // トークンが一致した場合
      // usersテーブルのemail_verifiedを更新する処理などを実行する
      User::where("id", $emailVerification->user_id)->update([
        "email_verified" => true,
      ]);

      // レスポンスを返す
      $response->getBody()->write("Token verification successful");
      return $response->withStatus(200);
    } else {
      // トークンが一致しなかった場合の処理

      // レスポンスを返す
      $response->getBody()->write("Token verification failed");
      return $response->withStatus(400);
    }
  }
}
