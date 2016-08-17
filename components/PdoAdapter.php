<?php

namespace components;

class PdoAdapter
{
    private static $_instance = null;

    private function __construct() {}

    protected function __clone() {}

    public static function getInstance() {
        if (is_null(self::$_instance)) {
            $config = include_once getcwd() . '/config/db.php';

            extract($config);

            if (isset($host) && isset($db) && isset($charset) && isset($user) && isset($pass)) {
                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                $opt = [
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$_instance = new \PDO($dsn, $user, $pass, $opt);
            } else {
                throw new AppNoDbConfigException('There is no config for database');
            }
        }

        return self::$_instance;
    }
}
