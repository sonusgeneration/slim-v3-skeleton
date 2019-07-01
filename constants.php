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
 *  |   DIRECTORY CONSTANTS
 *  |-------------------------------------------------------------------
 */
defined("DIR_BASE") OR define("DIR_BASE", __DIR__ . DIRECTORY_SEPARATOR);
defined("DIR_VENDOR") OR define("DIR_VENDOR", DIR_BASE . "vendor" . DIRECTORY_SEPARATOR);

/**
 *  |-------------------------------------------------------------------
 *  |   FILE CONSTANTS
 *  |-------------------------------------------------------------------
 */
defined("FILE_AUTOLOAD") OR define("FILE_AUTOLOAD", "autoload.php");
defined("FILE_MIDDLEWARES") OR define("FILE_MIDDLEWARES", "middlewares.php");
defined("FILE_ROUTES") OR define("FILE_ROUTES", "routes.php");
defined("FILE_ERROR_HANDLER") OR define("FILE_ERROR_HANDLER", "error-handler.php");