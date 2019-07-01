<?php
declare(strict_types=1);

namespace Application;

use \DI\Bridge\Slim\App;
use \DI\ContainerBuilder;
use \Psr\Container\ContainerInterface;
use \Application\Database\Sql;
use \Application\Session\Storage\NativeSessionStorage;
use \Application\Session\Storage\Handler\PdoSessionHandler;
use \Slim\HttpCache\CacheProvider;

# Verify access control...
if(!defined('APP_START')) {
    exit("Access denied.");
}

class Kernel extends App {

    protected function configureContainer(ContainerBuilder $builder) {
        $builder->addDefinitions([
            "settings" => [
                "debug"                             => true,
                "httpVersion"                       => "1.1",
                "responseChunkSize"                 => 4096,
                "outputBuffering"                   => "append",
                "determineRouteBeforeAppMiddleware" => false,
                "displayErrorDetails"               => true,
                "addContentLengthHeader"            => true,
                "routerCacheFile"                   => false
            ],

            "session.db.host"   => "mysql:host=localhost;port=3306;dbname=sample_mysqldb",
            "session.db.user"   => "sample_mysqluser",
            "session.db.passwd" => "sample_mysqluserpassword",
            "session.db.table"  => "SESSIONS",

            NativeSessionStorage::class => function (ContainerInterface $c) {
                return new NativeSessionStorage([], 
                    new \Application\Session\Storage\Handler\PdoSessionHandler(
                        new Sql(
                            $c->get("session.db.host"),
                            $c->get("session.db.user"),
                            $c->get("session.db.passwd")),
                            [ 
                                "db_table" => $c->get("session.db.table") 
                            ]));
            },

            "cache" => function () {
                return new CacheProvider();
            }
        ]);
    }

}