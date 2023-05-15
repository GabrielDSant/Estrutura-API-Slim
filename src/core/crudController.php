<?php

namespace src\core;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class crudController
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public static function hello($request, $response)  {
        $response->getBody()->write('Hello World');
        //$response->withStatus(500)
        return $response;
    }
}
