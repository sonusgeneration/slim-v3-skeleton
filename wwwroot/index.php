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
define("APP_START", microtime(true));

/**
 *  |-------------------------------------------------------------------
 *  |   APPLICATION ENVIRONMENT
 *  |-------------------------------------------------------------------
 *  |
 *  |   Use this to load an alternate configuration later on in the 
 *  |   Kernel depending on environment. Available values are:
 *  |       - development
 *  |       - production
 */
define("APP_ENV", file_get_contents("env.cfg"));

/**
 *  |-------------------------------------------------------------------
 *  |   BOOTSTRAP
 *  |-------------------------------------------------------------------
 *  |
 *  |   Let's get things prepared for a clean run.
 */
require("bootstrap.php");