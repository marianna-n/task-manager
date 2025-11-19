<?php

class DataBase
{
    private $connection = null;

    public static function getInstance(): DataBase
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new DataBase();
            $instance->establishConnection();
        }
        return $instance;
    }

    public function establishConnection(): void
    {
        global $db_config;
        global $db_options;
        $dsn = "mysql:dbname={$db_config['db_name']};host={$db_config['host']};charset=utf8";
        $this->connection = new PDO($dsn, $db_config['user'], $db_config['password'], $db_options);
    }

    /* public function query($sql)
    {
        return $this->connection->query($sql);
    }*/

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public function completeQuery($sql)
    {
        $request = $this->connection->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
