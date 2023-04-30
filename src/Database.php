<?php

class Database {
    private $host;
    private $name;
    private $user;
    private $pass;
    public function __construct(string $host,string $name,string $user,string $pass)
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->pass = $pass;
    }
    public function getConnection() :PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};Charset=utf8";
        return new PDO($dsn,$this->user,$this->pass,
        [
            PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_STRINGIFY_FETCHES => false
    ]);
    }
}