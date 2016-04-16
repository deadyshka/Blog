<?php namespace Epic;


class Route
{
    public function __construct()
    {

    }

    public function handle($uri, $routes)
    {
        $request = parse_url($uri);
        $params = [];
        if (!empty($request['query'])) {
            parse_str($request['query'], $params);
        }
        $action = empty($params['action']) ? 'Home' : $params['action'];
        if (isset($routes[$action])) {
            $controller = new $routes[$action](\Epic\Lib\connection());
            return $controller->handle($action, empty($_SERVER['REQUEST_METHOD']) ? 'get' : $_SERVER['REQUEST_METHOD'], $params);
        }

        return false;
    }
}