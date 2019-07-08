<?php
declare(strict_types=1);

namespace Application\Session\Storage\Handler;

use \Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler as SymfonyPdoSessionHandler;

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
 *  PDO SESSION HANDLER CLASS
 *  @since v1.0.0
 *
 *  @see \Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler
 */
final class PdoSessionHandler extends SymfonyPdoSessionHandler {

    /**
     *  @property \PDO|null $_pdo
     */
    private $_pdo = null;

    /**
     *  @property string $_table
     */
    private $_table = "sessions";

    /**
     *  @property string $_lifetime_column
     */
    private $_lifetime_column = 'sess_lifetime';

    /**
     *  @property string $_time_column
     */
    private $_time_column = 'sess_time';

    /**
     *  Class Constructor
     *  @since v1.0.0
     *
     *  @param \PDO $pdo
     *  @param array $options
     */
    public function __construct(\PDO $pdo, array $options = []) {
        $this->_pdo = $pdo;
        $this->_table = isset($options["db_table"]) ? $options["db_table"] : $this->_table;

        parent::__construct($pdo, $options);
    }

    /**
     *  Clean
     *  @since v1.0.0
     *
     *  @return void
     */
    public function clean() : void {
        $stmt = $this->_pdo->prepare("DELETE FROM "
            . $this->_table 
            . " WHERE " 
            . $this->_lifetime_column 
            . " + " 
            . $this->_time_column 
            . " < :time");
        $stmt->bindValue(':time', time(), \PDO::PARAM_INT);
        $stmt->execute();
        $stmt = NULL;
    }

}