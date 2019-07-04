<?php
declare(strict_types=1);

namespace Application;

use \DI\Bridge\Slim\App;
use \DI\ContainerBuilder;

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

class Kernel extends App {

    protected function configureContainer(ContainerBuilder $builder) {
        $config = require_once(DIR_CONFIG . FILE_CONFIG_PRODUCTION);
        if(ENV_DEVELOPMENT === APP_ENV) {
            $config = array_merge($config, require_once(DIR_CONFIG . FILE_CONFIG_DEVELOPMENT));
        }

        $builder->addDefinitions(DIR_CONFIG . FILE_CONFIG_PRODUCTION);

    }

}