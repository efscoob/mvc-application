<?php

namespace Application;

class Db
{
    
    private $_dbh;

    use TSingletone;
    
    private function __construct()
    {
        $config = Config::getInstance()->data;
        $this->_dbh = new \PDO("mysql:host={$config['db']['localhost']};dbname={$config['db']['dbname']}", $config['db']['login'], $config['db']['pass']);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function execute(string $sql, array $params = []) {
        $sth = $this->_dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array $params
     * @return array
     */
    public function query(string $sql, string $class = 'stdClass', array $params = [])
    {
        $sth = $this->_dbh->prepare($sql);
        $res = $sth->execute($params);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    /**
     * @return string
     */
    public function lastInsertId() {
        return $this->_dbh->lastInsertId();
    }
}