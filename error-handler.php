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

#   Get container...
$container = $app->getContainer();

#   Configure error handler / debugger...
$whoopsGuard = new \Zeuxisoo\Whoops\Provider\Slim\WhoopsGuard();
$whoopsGuard->setApp($app);
$whoopsGuard->setRequest($container->get('request'));
$whoopsGuard->setHandlers([]);
$whoopsGuard->install();