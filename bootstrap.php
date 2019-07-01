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

/**
 *  |-------------------------------------------------------------------
 *  |   CONSTANTS
 *  |-------------------------------------------------------------------
 *  |
 *  |   Load application constants for use throughout the project.
 */
require("constants.php");

/**
 *  |-------------------------------------------------------------------
 *  |   COMPOSER
 *  |-------------------------------------------------------------------
 *  |
 *  |   Load composer "autoload.php" to allow for loading of dependency
 *  |   libraries and PSR-4 compliant application classes.
 */
require(DIR_VENDOR . FILE_AUTOLOAD);


/**
 *  |-------------------------------------------------------------------
 *  |   KERNEL
 *  |-------------------------------------------------------------------
 *  |   
 *  |   Load the application Kernel to begin processing the request
 *  |   pipeline.
 */
$app = new \Application\Kernel();

/**
 *  |-------------------------------------------------------------------
 *  |   ERROR HANDLER
 *  |-------------------------------------------------------------------
 *  |
 *  |   Set the application error handler; by default this is the PHP
 *  |   Whoops! library.
 */
require(FILE_ERROR_HANDLER);

/**
 *  |-------------------------------------------------------------------
 *  |   MIDDLEWARES
 *  |-------------------------------------------------------------------
 *  |
 *  |   Load the application middlewares. A database session middleware
 *  |   based on Symfony HttpFoundation is included by default.
 */
require(FILE_MIDDLEWARES);

/**
 *  |-------------------------------------------------------------------
 *  |   ROUTES
 *  |-------------------------------------------------------------------
 *  |
 *  |   Load the application routes.
 */
require(FILE_ROUTES);

#   Let's go...
$app->run();