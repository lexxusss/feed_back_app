<?php

namespace components;

class AppController
{
    public static function render($file = 'index', $params = array(), $viewDirName = null, $exit = true)
    {
        $viewDirName = $viewDirName ?: self::getViewDirName(debug_backtrace());

        $path = getcwd() . '/src/view/' . $viewDirName . '/' . $file . '.php';
        if (file_exists($path)) {
            $content = self::getContent($path, $params);
            $page = self::getContent( getcwd() . '/src/view/layout/main_layout.php', compact('content'));

            die($page);
        } else {
            throw new AppNoFileException('There is no such file: ' . $path);
        }
    }

    public static function getContent($path, $params)
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

    public function refreshWithErrors($errors)
    {
        foreach ($errors as $error) {
            request()->setFlash('warning', $error);
        }

        request()->redirect();
    }

    public function refreshWithSuccesses($successes)
    {
        foreach ($successes as $success) {
            request()->setFlash('success', $success);
        }

        request()->redirect();
    }
}
