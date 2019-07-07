<?php
declare(strict_types=1);

namespace Controllers;

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
 *  HOME CONTROLLER
 *  @since v1.0.0
 *
 *  @see \Psr\Http\Message\RequestInterface
 *  @see \Psr\Http\Message\ResponseInterface
 */
class HomeController {

    /**
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {}

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {}

    /**
     *  ActionIndex
     *  @since v1.0.0
     *
     *  @param \Psr\Http\Message\RequestInterface $request
     *  @param \Psr\Http\Message\ResponseInterface $response
     *  @return \Psr\Http\Message\ResponseInterface
     */
    public function ActionIndex(RequestInterface $request, ResponseInterface $response) : ResponseInterface {
        $response->getBody()
            ->write("Hello, world!");

        return $response;
    }

}