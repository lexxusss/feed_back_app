<?php

namespace components;

class AppController
{
    public function render($file = 'index', $params = array())
    {
        $callstack = debug_backtrace();

        $viewDirName = self::getViewDirName($callstack);

        $path = 'view/' . $viewDirName . '/' . $file . '.php';

        if (file_exists($path)) {
            $content = self::getContent($path, $params);
            $page = self::getContent(__DIR__ . '/../view/layout/main_layout.php', compact('content'));

            die($page);
        } else {
            throw new AppNoFileException('There is no such file');
        }
    }

    private static function getContent($path, $params)
    {
        extract($params);

        ob_start();
        require_once $path;
        $content = ob_get_clean();

        return $content;
    }

    private static function getViewDirName($callstack)
    {
        $called = $callstack[1];
        $calledClass = $called['class'];

        $class = explode('\\', $calledClass);
        $class = $class[1];
        $class = substr($class, 0, strpos($class, 'Controller'));

        return strtolower($class);
    }
}
