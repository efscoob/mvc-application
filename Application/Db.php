<?php

namespace Application;

class Db
{
    private static $instance;
    private $_dbh;
    
    private function __construct()
    {
        $data = Config::getInstance()->data;
        $this->_dbh = new \PDO("mysql:host={$data['localhost']};dbname={$data['dbname']}", $data['login'], $data['pass']);
    }

    public static function getInstance() {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function execute(string $sql, array $params = []) {
        $sth = $this->_dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    public function query(string $sql, string $class = 'stdClass', array $params = [])
    {
        $sth = $this->_dbh->prepare($sql);
        $res = $sth->execute($params);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    public function lastInsertId() {
        return $this->_dbh->lastInsertId();
    }
}