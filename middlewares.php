<?php
declare(strict_types=1);

use \Application\Middlewares\SessionMiddleware;
use \Application\Middlewares\AccessLoggingMiddleware;

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

#   Middleware definitions...
$app->add(SessionMiddleware::class);
$app->add(AccessLoggingMiddleware::class);