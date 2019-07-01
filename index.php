<?php
declare(strict_types=1);

/**
 *  |-------------------------------------------------------------------
 *  |   ACCESS CONTROL KEY
 *  |-------------------------------------------------------------------
 *  |
 *  |   Set the access control key. This is the key we will check for
 *  |   in each additional application file to ensure direct script
 *  |   access is not allowed.
 */
define("APP_START", microtime(TRUE));

/**
 *  |-------------------------------------------------------------------
 *  |   BOOTSTRAP
 *  |-------------------------------------------------------------------
 *  |
 *  |   Let's get things prepared for a clean run.
 */
require("bootstrap.php");