<?php
declare(strict_types=1);

namespace Controllers;

use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

# Verify access control...
if(!defined('APP_START')) {
    exit("Access denied.");
}

class HomeController {

    public function ActionIndex(RequestInterface $request, ResponseInterface $response) : ResponseInterface {
        $response->getBody()
            ->write("Hello, world!");

        return $response;
    }

}