<?php
use scope\core\Environment;
use scope\web\Controller;
use scope\db\Query;

class Scope{

    const STATUS_CODE_SUCCESS = 0;
    const STATUS_CODE_HTML_EXCEPTION = 1;

    public static $statusCode = 0;
    public static $context;
    public static $environment;
    public static $controller;

    public static function run(){
        include('autoloader.php');

        Scope::$context = new ScopeContext();
        Scope::$context->path =dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR;

        Scope::$environment = Environment::fromHost( $_SERVER['HTTP_HOST'] );

        return Controller::handle( Controller::parse( $_SERVER['REQUEST_URI'] ) );
    }

    public static function query(){
        return new Query();
    }

    public static function uid(){
        return "w" . ++Scope::$context->uids . "_" . uniqid();
    }
}

class ScopeContext{
    public $path;
    public $uids = 0;
}
?>
