<?php
declare(strict_types=1);

namespace Application\Loggers;

use \Monolog\Logger;

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
 *  ERROR LOGGER
 *  @since v1.0.0
 *
 *  @see \Monolog\Logger
 */
final class ErrorLogger extends Logger {}