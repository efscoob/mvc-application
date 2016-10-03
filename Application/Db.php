<?php

namespace Application;

class Db
{
    protected $_dbh;

    public function __construct()
    {
        $this->_dbh = new \PDO("mysql:host=localhost;dbname=webapp", "root", "");
    }

    public function execute(string $sql, array $params = []) {
        $sth = $this->_dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    public function query(string $sql, string $class = 'stdClass') {
        $sth = $this->_dbh->prepare($sql);
        $res = $sth->execute();
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
}