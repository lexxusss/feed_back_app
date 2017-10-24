<?php

namespace components;

use model\User;

class HttpRequest
{
    private static $_instance = null;

    private function __construct() {}
    
    protected function __clone() {}

    public static function getInstance() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Returns the named POST parameter value.
     * If the POST parameter does not exist, the second parameter to this method will be returned.
     *
     * @param string $name the POST parameter name
     * @param mixed $default the default parameter value if the POST parameter does not exist.
     *
     * @return mixed the POST parameter value
     */
    public function getPost($name = null, $default = null)
    {
        return !$name ? $_POST : (isset($_POST[$name]) ? $_POST[$name] : $default);
    }

    /**
     * Returns the named GET parameter value.
     * If the GET parameter does not exist, the second parameter to this method will be returned.
     *
     * @param string $name the GET parameter name
     * @param mixed $default the default parameter value if the GET parameter does not exist.
     *
     * @return mixed the GET parameter value
     */
    public function getQuery($name = null, $default = null)
    {
        return !$name ? $_GET : (isset($_GET[$name]) ? $_GET[$name] : $default);
    }

    public function get($name = null, $default = null)
    {
        return $_POST ? $this->getPost($name, $default) : $this->getQuery($name, $default);
    }

    public function getFile($name = null, $default = null)
    {
        return !$name ? $_FILES : (isset($_FILES[$name]) ? $_FILES[$name] : $default);
    }

    public function redirect($url = '')
    {
        header('Location: ' . $url);
    }

    public function redirectBack()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function redirectHome()
    {
        $this->redirect($this->home());
    }

    public function getFullUrl()
    {
        return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    public function home()
    {
        return "http://$_SERVER[HTTP_HOST]/index.php";
    }

    public function getPathInfo()
    {
        return @$_SERVER['PATH_INFO'];
    }

    public function setFlash($status, $message)
    {
        $_SESSION['flashes'][][$status] = $message;
    }
    
    public function getFlashes()
    {
        $flashes = array();
        
        if (!empty($_SESSION['flashes'])) {
            $flashes = $_SESSION['flashes'];
            unset($_SESSION['flashes']);
        }
        
        return $flashes;
    }
    
    public function cleanFlashes()
    {
        if (!empty($_SESSION['flashes'])) {
            unset($_SESSION['flashes']);
        }
    }

    public function setUser($user)
    {
        $_SESSION['user'] = $user;
    }
    
    public function getUser()
    {
        return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
    }
    
    public function isUserAdmin()
    {
        return $this->getUser() && $this->getUser()->role == 'admin';
    }
    
    public function isLoggedIn()
    {
        return !empty($_SESSION['user']);
    }
    
    public function logout()
    {
        if (self::isLoggedIn()) {
            unset($_SESSION['user']);
        }
    }
}
