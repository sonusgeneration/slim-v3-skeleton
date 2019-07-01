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

#   Route definitions...
$app->get("/", [\Controllers\HomeController::class, "ActionIndex"]);