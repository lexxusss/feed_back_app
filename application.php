<?php

namespace main;

use components\HttpRequest;
use components\PdoAdapter;

class Application
{
    public function run()
    {
        $request = Application::request();

        $controller = 'controller\IndexController';
        $method = 'indexAction';

        $this->getControllerName($controller, $method, $request->getPathInfo());

        $controller = new $controller();
        $controller->$method();
        die();
    }

    private function getControllerName(&$controller, &$method, $path)
    {
        $path = explode('/', $path);
        $path = array_filter($path, function ($v) {return !empty(trim($v));});
        $path = array_values($path);

        if (!empty($path[0])) {
            $controller = 'controller\\' . ucfirst($path[0]) . 'Controller';

            if (!empty($path[1])) {
                $method = $path[1] . 'Action';
            }
        }
    }

    /**
     * get PDO-instance
     * 
     * @return \PDO
     */
    public static function pdo()
    {
        return PdoAdapter::getInstance();
    }

    /**
     * get Http Request
     * 
     * @return HttpRequest|null
     */
    public static function request()
    {
        return HttpRequest::getInstance();
    }
}
