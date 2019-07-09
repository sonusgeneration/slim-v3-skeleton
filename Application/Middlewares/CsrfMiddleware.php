<?php
declare(strict_types=1);

namespace Application\Middlewares;

use \Slim\Csrf\Guard;

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
 *  CSRF MIDDLEWARE
 *  @since v1.0.0
 *
 *  @see \Slim\Csrf\Guard
 */
final class CsrfMiddleware extends Guard  { }