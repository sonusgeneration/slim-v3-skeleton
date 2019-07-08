<?php
declare(strict_types=1);

namespace Application\Middlewares;

use \Application\Loggers\AccessLogger;
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

/**
 *  SESSION MIDDLEWARE
 *  @since v1.0.0
 */
final class AccessLoggingMiddleware {

    /**
     *  @property \Application\Logger\AccessLogger $_access_logger
     */
    private $_access_logger = null;

    /**
     *  Class Constructor
     *  @since v1.0.0
     *
     *  @param \Application\Logger\AccessLogger $container
     */
    public function __construct(AccessLogger $access_logger) {
        $this->_access_logger = $access_logger;
    }

    /**
     *  Middleware __invoke
     *  @since v1.0.0
     *
     *  @param \Psr\Http\Message\ServerRequestInterface $request
     *  @param \Psr\Http\Message\ResponseInterface $response
     *  @param callable $next
     *  @return \Psr\Http\Message\ResponseInterface  
     */
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