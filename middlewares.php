<?php
declare(strict_types=1);

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
$app->add(\Application\Middlewares\SessionMiddleware::class);