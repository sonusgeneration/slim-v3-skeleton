<?php
declare(strict_types=1);

namespace Controllers\ErrorHandlers;

use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;
use \Application\Loggers\ErrorLogger;

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
 *  CUSTOM ERROR CONTROLLER
 *  @since v1.0.0
 *
 *  @see \Psr\Http\Message\RequestInterface
 *  @see \Psr\Http\Message\ResponseInterface
 */
final class CustomErrorController {

    private $_error_logger = null;

    public function __construct(ErrorLogger $error_logger) {
        $this->_error_logger = $error_logger;
    }

    /**
     *  Route __Invoke
     *  @since v1.0.0
     *
     *  @param \Psr\Http\Message\RequestInterface $request
     *  @param \Psr\Http\Message\ResponseInterface $response
     *  @param \Exception $exception
     *  @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, \Exception $exception) : ResponseInterface {
        $response->getBody()
            ->write("<h1>500 Internal Server Error</h1><h3>Custom</h3><p>An error has occurred processing the request.</p>");

        return $response;
    }

}