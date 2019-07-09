<?php
declare(strict_types=1);

use \Psr\Container\ContainerInterface;
use \Application\Database\Sql;
use \Application\Session\Storage\NativeSessionStorage;
use \Application\Session\Storage\Handler\PdoSessionHandler;
use \Slim\HttpCache\CacheProvider;
use \Application\Loggers\AccessLogger;
use \Application\Loggers\ErrorLogger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;
use \Psr\Log\LoggerInterface;
use \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage as SymfonyNativeSessionStorage;
use \Controllers\ErrorHandlers\ResourceNotFoundController;
use \Controllers\ErrorHandlers\MethodNotAllowedController;
use \Controllers\ErrorHandlers\CustomErrorController;
use \Controllers\ErrorHandlers\PhpErrorController;

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
    Sql::class => function (ContainerInterface $c) : \PDO {
        return new Sql(
                $c->get("db.host"),
                $c->get("db.user"),
                $c->get("db.passwd")
            );
    },

    # Session database handler...
    NativeSessionStorage::class => function (ContainerInterface $c) : SymfonyNativeSessionStorage {
        return new NativeSessionStorage([], 
            new PdoSessionHandler(
                $c->get(Sql::class), 
                [ "db_table" => $c->get("session.db.table") ]));
    },

    # Cache provider...
    CacheProvider::class => function () : CacheProvider {
        return new CacheProvider();
    },

    # Access logger...
    AccessLogger::class => function (ContainerInterface $c) : LoggerInterface {
        $logger = new AccessLogger("access_logger");
        $handler = new StreamHandler(DIR_LOGS_ACCESS . FILE_LOG_ACCESS , AccessLogger::INFO);
        $handler->setFormatter(new LineFormatter("%message%\n"));
        $logger->pushHandler($handler);

        return $logger;
    },

    # Error logger...
    ErrorLogger::class => function (ContainerInterface $c) : LoggerInterface {
        $logger = new ErrorLogger("error_logger");
        $handler = new StreamHandler(DIR_LOGS_ERROR . FILE_LOG_ERROR , ErrorLogger::DEBUG);
        $handler->setFormatter(new LineFormatter("%message%\n"));
        $logger->pushHandler($handler);

        return $logger;
    },

    # 404 Resource Not Found handler...
    "notFoundHandler" => function () {
        return new ResourceNotFoundController();
    },

    # 405 Method Not Allowed handler...
    "notAllowedHandler" => function () {
        return new MethodNotAllowedController();
    },

    # Custom Error handler...
    "errorHandler" => function (ContainerInterface $c) {
        return new CustomErrorController($c->get(ErrorLogger::class));
    },

    # PHP Error handler...
    "phpErrorHandler" => function (ContainerInterface $c) {
        return new PhpErrorController($c->get(ErrorLogger::class));
    }
];