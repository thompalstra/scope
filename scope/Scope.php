<?php
use scope\base\Environment;

use scope\web\Controller;

class Scope{

    public static $context;
    public static $environment;
    public static $controller;

    public static function run(){
        include('autoloader.php');

        Scope::$context = new ScopeContext();
        Scope::$context->path = dirname(__DIR__);

        Scope::$environment = Environment::fromHost( $_SERVER['HTTP_HOST'] );

        return Scope::$controller = Controller::handle( Controller::parse( $_SERVER['REQUEST_URI'] ) );
    }
}

class ScopeContext{
    public $path;
}
?>
