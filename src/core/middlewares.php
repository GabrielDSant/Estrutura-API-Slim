<?php

namespace src\core;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

class middlewaresClass
{
    public $request;
    public $response;
    
    public function __construct($request)
    {
        $this->request = $request;
    }

    public static function logger($request, $response)
    {
        if (DEBUG) {
            $dirLogs = __DIR__.'/../debug/'.date('d_m_Y');
            $nomeArquivo = __DIR__.'/../debug/'.date('d_m_Y').'/log_' . date('d_m_Y') . '.txt';

            if (is_dir($dirLogs)) {
                $myfile = fopen($nomeArquivo, "a");
                fwrite($myfile, middlewaresClass::logHandler($request, $response));
                fclose($myfile);
            } else {
                mkdir($dirLogs);
                $myfile = fopen($nomeArquivo, "a");
                fwrite($myfile, middlewaresClass::logHandler($request, $response));
                fclose($myfile);
            }
        }
    }

    public static function logHandler($request, $response)
    {
        date_default_timezone_set("America/Sao_Paulo");
        $dia = (string) date('d/m/Y G:i:s');
        $status = $response->getStatusCode();
        $uri = (string) $request->getUri();
        $serverIp = $request->getServerParams()['REMOTE_ADDR'];
        $userIp = $request->getAttribute('ip_address');

        $requestBody = (string) $request->getBody();
        $responseBody = (string) $response->getBody();

        //Estrutura de um registro de Log.

        $registro =  "---------------------LOG-------------------------\n" . 
        "Requisição feita em " . $dia . "\n" . 
        "Na URI: ". $uri . "\n" .
        "Ip Servidor: " . $serverIp . "\n" .
        "Ip do Usuário: " . $userIp . "\n" .
        "Status da Requisição :" .$status . "\n" .
        "---------------------Request---------------------\n" . 
        $requestBody . "\n" .
        "---------------------Response--------------------\n" . 
        $responseBody . "\n" .
        "---------------------END-------------------------\n\n\n";
        return $registro;

    }
}
