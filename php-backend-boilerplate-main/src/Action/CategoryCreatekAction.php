<?php
namespace App\Action;

use App\Model\User;
use App\Model\Category;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryCreatekAction
{
  public function __invoke(Request $request, Response $response): Response
  {
    $requestBody = $request->getBody()->getContents();
    $decodedRequestBody = json_decode($requestBody);
    $name = $decodedRequestBody->name; 


    if ($name) {
      $category = new Category();
      $category->name = $name;
      $category->save();
      $response->getBody()->write(json_encode("Success"));
      return $response->withStatus(200);

    } else {
      $response->getBody()->write("カテゴリーが作成できません。");
      return $response->withStatus(400);
    }
  }
}
