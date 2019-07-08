<?php
declare(strict_types=1);

use \Psr\Container\ContainerInterface;
use \Application\Database\Sql;
use \Application\Session\Storage\NativeSessionStorage;
use \Application\Session\Storage\Handler\PdoSessionHandler;
use \Slim\HttpCache\CacheProvider;
use \Application\Loggers\AccessLogger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;

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
    # General settings...
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

    # Database settings...
    "db.host"   => "mysql:host=localhost;port=3306;dbname=sample_mysqldb",
    "db.user"   => "sample_mysqluser",
    "db.passwd" => "sample_mysqluserpassword",

    # Session settings...
    "session.db.table"  => "SESSIONS",

    # Pdo sql wrapper...
    Sql::class => function (ContainerInterface $c) {
        return new Sql(
                $c->get("db.host"),
                $c->get("db.user"),
                $c->get("db.passwd")
            );
    },

    # Session database handler...
    NativeSessionStorage::class => function (ContainerInterface $c) {
        return new NativeSessionStorage([], 
            new PdoSessionHandler(
                $c->get(Sql::class), 
                [ "db_table" => $c->get("session.db.table") ]));
    },

    # Cache provider...
    CacheProvider::class => function () {
        return new CacheProvider();
    },

    # Access logger...
    AccessLogger::class => function (ContainerInterface $c) {
        $logger = new AccessLogger("access_logger");
        $handler = new StreamHandler(DIR_LOGS_ACCESS . FILE_LOG_ACCESS , AccessLogger::INFO);
        $handler->setFormatter(new LineFormatter("%message%\n"));
        $logger->pushHandler($handler);

        return $logger;
    }
];