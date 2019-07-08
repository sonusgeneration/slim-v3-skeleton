<?php
declare(strict_types=1);

namespace Application\Middlewares;

use \Symfony\Component\HttpFoundation\Session\Session;
use \Application\Session\Storage\NativeSessionStorage;
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
 *  
 *  @see \Symfony\Component\HttpFoudation\Session\Session
 */
final class SessionMiddleware extends Session {

    /**
     *  Class Constructor
     *  @since v1.0.0
     *
     *  @param \Application\Session\Storage\NativeStorageHandler $storage
     */
    public function __construct(NativeSessionStorage $storage) {
        parent::__construct($storage, NULL, NULL);
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
        # Start the session...
        $this->start();
        
        # Next middleware...
        $response = $next($request, $response);
        
        # Clean sessions...
        $this->storage->clean();

        return $response;
    }

}