<?php

declare(strict_types=1);

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserListAction
{
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write('bbbbbbbbbbbbbbb');
        return $response;
    }
}
