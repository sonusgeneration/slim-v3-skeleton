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
 *  RESOURCE NOT FOUND CONTROLLER
 *  @since v1.0.0
 *
 *  @see \Psr\Http\Message\RequestInterface
 *  @see \Psr\Http\Message\ResponseInterface
 */
final class ResourceNotFoundController {

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
            ->write("<h1>Not Found</h1><p>The requested resource could not be found.</p>");

        return $response;
    }

}