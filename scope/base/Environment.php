<?php
namespace scope\base;

class Environment{
    public static function fromHost( $httpHost ){
        $env =                  new self();
        $env->name =            self::getName( $httpHost );
        $env->viewPath =        self::getViewPath( $httpHost );
        $env->controllerPath =  self::getControllerPath( $httpHost );
        return $env;
    }

    public static function getName( $httpHost ){
        $explode = explode('.', $httpHost);
        return ( count( $explode) > 2 ) ? $explode[0] : 'frontend';
    }

    public static function getViewPath( $httpHost ){
        $explode = explode('.', $httpHost);
        return \Scope::$context->path . DIRECTORY_SEPARATOR . ( ( count( $explode) > 2 ) ? $explode[0] : 'frontend' )  . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
    }
    public static function getControllerPath( $httpHost ){
        $explode = explode('.', $httpHost);
        return \Scope::$context->path . DIRECTORY_SEPARATOR . ( ( count( $explode) > 2 ) ? $explode[0] : 'frontend' )  . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;
    }
}
?>
