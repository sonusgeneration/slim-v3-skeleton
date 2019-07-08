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
defined("DIR_CONFIG") OR define("DIR_CONFIG", DIR_BASE . "config" . DIRECTORY_SEPARATOR);
defined("DIR_TMP") OR define("DIR_TMP", DIR_BASE . "tmp" . DIRECTORY_SEPARATOR);
defined("DIR_CACHE") OR define("DIR_CACHE", DIR_TMP . "cache" . DIRECTORY_SEPARATOR);
defined("DIR_LOGS") OR define("DIR_LOGS", DIR_TMP . "logs" . DIRECTORY_SEPARATOR);
defined("DIR_LOGS_ACCESS") OR define("DIR_LOGS_ACCESS", DIR_LOGS . "access" . DIRECTORY_SEPARATOR);
defined("DIR_LOGS_ERROR") OR define("DIR_LOGS_ERROR", DIR_LOGS . "error" . DIRECTORY_SEPARATOR);

/**
 *  |-------------------------------------------------------------------
 *  |   FILE CONSTANTS
 *  |-------------------------------------------------------------------
 */
defined("FILE_AUTOLOAD") OR define("FILE_AUTOLOAD", "autoload.php");
defined("FILE_MIDDLEWARES") OR define("FILE_MIDDLEWARES", "middlewares.php");
defined("FILE_ROUTES") OR define("FILE_ROUTES", "routes.php");
defined("FILE_ERROR_HANDLER") OR define("FILE_ERROR_HANDLER", "error-handler.php");
defined("FILE_CONFIG_PRODUCTION") OR define("FILE_CONFIG_PRODUCTION", "app.php");
defined("FILE_CONFIG_DEVELOPMENT") OR define("FILE_CONFIG_DEVELOPMENT", "app.dev.php");
defined("FILE_LOG_ACCESS") OR define("FILE_LOG_ACCESS", "access." . date("Y-m-d") . ".log");
defined("FILE_LOG_ERROR") OR define("FILE_LOG_ERROR", "error." . date("Y-m-d") . ".log");

/**
 *  |-------------------------------------------------------------------
 *  |   ENVIRONMENT CONSTANTS
 *  |-------------------------------------------------------------------
 */
defined("ENV_DEVELOPMENT") OR define("ENV_DEVELOPMENT", "development");
defined("ENV_PRODUCTION") OR define("ENV_PRODUCTION", "production");