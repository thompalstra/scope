<?php
use scope\base\Environment;

class Scope{

    public static $context;
    public static $environment;

    public static function run(){
        include('autoloader.php');

        Scope::$context = new ScopeContext();
        Scope::$context->path = dirname(__DIR__);

        Scope::$environment = Environment::fromHost( $_SERVER['HTTP_HOST'] );



        var_dump(Scope::$environment);
    }
}

class ScopeContext{
    
}
?>
