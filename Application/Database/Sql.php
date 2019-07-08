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

/**
 *  SQL CLASS
 *  @since v1.0.0
 *
 *  @see \PDO
 */
final class Sql extends \PDO {

    /**
     *  Class Constructor
     *  @since v1.0.0
     *
     *  @param string $dsn
     *  @param string $user
     *  @param string $passwd
     *  @param array $options
     */
    public function __construct(string $dsn, string $user, string $passwd, array $options = []) {
        parent::__construct($dsn, $user, $passwd, $options);

        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(\PDO::ATTR_EMULATE_PREPARES , false);
    }

}