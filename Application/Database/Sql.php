<?php
declare(strict_types=1);

namespace Application\Database;

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

final class Sql extends \PDO {

    public function __construct(string $dsn, string $user, string $passwd, array $options = []) {
        parent::__construct($dsn, $user, $passwd, $options);

        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(\PDO::ATTR_EMULATE_PREPARES , FALSE);
    }

}