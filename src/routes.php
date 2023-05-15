<?php

require_once(__DIR__ . '/core/crudController.php');
require_once(__DIR__ . '/core/middlewares.php');

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use src\core\crudController;
use src\core\middlewaresClass;


/**
 * Grupo dos enpoints iniciados por v1
*/

$app->add(new RKA\Middleware\IpAddress());


$logger = function (Request $request, RequestHandler $handler){
    $response = $handler->handle($request);
    //$response->getBody()->write('World');
    middlewaresClass::logger($request, $response);
    return $response;
};

 $app->post('/', function (Request $request, Response $response) {
    return crudController::hello($request, $response);
})->add($logger)

?>