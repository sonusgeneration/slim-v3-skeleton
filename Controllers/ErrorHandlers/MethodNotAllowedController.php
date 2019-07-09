<?php
declare(strict_types=1);

namespace Controllers\ErrorHandlers;

use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

/**
 *  |-------------------------------------------------------------------
 *  |   ACCESS CONTROL
 *  |-------------------------------------------------------------------
 *  |
 *  |   We don't allow direct access to files other than "index.php".
 */
if(!defined('APP_START')) {
    exit("Access denied.");
}

/**
 *  METHOD NOT ALLOWED CONTROLLER
 *  @since v1.0.0
 *
 *  @see \Psr\Http\Message\RequestInterface
 *  @see \Psr\Http\Message\ResponseInterface
 */
final class MethodNotAllowedController {

    /**
     *  Route __Invoke
     *  @since v1.0.0
     *
     *  @param \Psr\Http\Message\RequestInterface $request
     *  @param \Psr\Http\Message\ResponseInterface $response
     *  @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response) : ResponseInterface {
        $response->getBody()
            ->write("<h1>Not Allowed</h1><p>The requested method is not allowed for the specified route.</p>");

        return $response;
    }

}