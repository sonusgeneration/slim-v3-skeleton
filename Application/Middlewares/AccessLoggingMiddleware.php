<?php
declare(strict_types=1);

namespace Application\Middlewares;

use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface;
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

final class AccessLoggingMiddleware {

    private $_access_logger = null;

    public function __construct(ContainerInterface $container) {
        $this->_access_logger = $container->get("access_logger");
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next) {     
        # Next middleware...
        $response = $next($request, $response);
        
        # Log access...
        $this->_access_logger->info($request->getServerParams()['REMOTE_ADDR']
            . " - [" . date("d/M/Y:H:i:s O")
            . "] \""
            . $request->getMethod()
            . " "
            . $request->getUri()
            . " HTTP/"
            . $response->getProtocolVersion()
            . "\" "
            . $response->getStatusCode()
            . " "
            . $response->getReasonPhrase()
            . " - "
            . $request->getServerParams()['HTTP_USER_AGENT']);

        return $response;
    }

}