<?php namespace Epic\Controllers;

abstract class Controller
{
    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function handle($action, $method, $params)
    {
        $handler = $this->handler($action, $method);

        return $this->{$handler}($params);
    }

    protected function handler($action, $method)
    {
        $method = strtolower($method);
        $action = ucfirst($action);
        $handler = "{$method}{$action}";

        return $handler;
    }


}