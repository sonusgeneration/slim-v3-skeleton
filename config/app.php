<?php
declare(strict_types=1);

use \Psr\Container\ContainerInterface;
use \Application\Database\Sql;
use \Application\Session\Storage\NativeSessionStorage;
use \Application\Session\Storage\Handler\PdoSessionHandler;
use \Slim\HttpCache\CacheProvider;

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

return [
    "settings" => [
        "debug"                             => false,
        "httpVersion"                       => "1.1",
        "responseChunkSize"                 => 4096,
        "outputBuffering"                   => "append",
        "determineRouteBeforeAppMiddleware" => false,
        "displayErrorDetails"               => false,
        "addContentLengthHeader"            => true,
        "routerCacheFile"                   => false
    ],

    "db.host"   => "mysql:host=localhost;port=3306;dbname=sample_mysqldb",
    "db.user"   => "sample_mysqluser",
    "db.passwd" => "sample_mysqluserpassword",

    "session.db.table"  => "SESSIONS",

    Sql::class => function (ContainerInterface $c) {
        return new Sql(
                $c->get("db.host"),
                $c->get("db.user"),
                $c->get("db.passwd")
            );
    },

    NativeSessionStorage::class => function (ContainerInterface $c) {
        return new NativeSessionStorage([], 
            new PdoSessionHandler(
                $c->get(Sql::class), 
                [ "db_table" => $c->get("session.db.table") ]));
    },

    "cache" => function () {
        return new CacheProvider();
    }
];