<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use Slim\Factory\AppFactory;

define('DEBUG', True);

require __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

require_once '../routes.php';

$app->run();

?>