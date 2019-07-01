<?php
declare(strict_types=1);

namespace Application\Session\Storage\Handler;

use \Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler as SymfonyPdoSessionHandler;

# Verify access control...
if(!defined('APP_START')) {
    exit("Access denied.");
}

final class PdoSessionHandler extends SymfonyPdoSessionHandler {

    private $_pdo = NULL;

    private $_table = "sessions";

    private $_lifetimeCol = 'sess_lifetime';

    private $_timeCol = 'sess_time';

    public function __construct(\PDO $pdo, array $options = []) {
        $this->_pdo = $pdo;
        $this->_table = isset($options["db_table"]) ? $options["db_table"] : $this->_table;

        parent::__construct($pdo, $options);
    }

    public function clean() {
        $stmt = $this->_pdo->prepare("DELETE FROM " . $this->_table . " WHERE " . $this->_lifetimeCol . " + " . $this->_timeCol . " < :time");
        $stmt->bindValue(':time', time(), \PDO::PARAM_INT);
        $stmt->execute();
        $stmt = NULL;
    }

}