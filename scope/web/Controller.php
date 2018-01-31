<?php
namespace scope\web;

use scope\base\exceptions\ScopeException;

class Controller extends \scope\base\Base{
    public static function parse( $request_uri ){


        return [$request_uri, $_GET];
    }
    public static function handle( $route ){
        $request_uri = trim( $route[0], '/' );
        $params = $route[1];

        $parts = explode('/', $request_uri);

        $actionId = null;
        $controllerId = null;
        $path = null;

        if( count( $parts ) > 0 ){
            $actionId = $parts[ count( $parts ) -1 ];
            array_pop( $parts );
        } else {
            $actionId = \Scope::$environment->web['action'];
        }

        if( count( $parts ) > 0 ){
            $controllerId = $parts[ count( $parts ) -1 ];
            array_pop( $parts );
        } else {
            $controllerId = \Scope::$environment->web['controller'];
        }

        if( count( $parts ) > 0 ){
            $path = implode( DIRECTORY_SEPARATOR, $parts ) . DIRECTORY_SEPARATOR;
        }

        $controller = self::createName( $controllerId ) . 'Controller';

        $viewPath = \Scope::$environment->viewPath . $path . $actionId . '.php';
        $controllerClass = \Scope::$environment->name . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $path . $controller;

        if( !class_exists( $controllerClass ) ){
            $defaultController = self::getDefaultController();
            return $defaultController->runError( new Exception("$controllerClass does not exist", 404 ) );
        }


        if( !file_exists( $viewPath ) ){
            $defaultController = self::getDefaultController();
            return $defaultController->runError( new \Exception( "$viewPath does not exist", 404 ) );
        }

        $c = new $controllerClass();
        return $c->runAction( $actionId );
    }

    public static function getDefaultController(){
        $controllerClass = \Scope::$environment->name . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . self::createName( \Scope::$environment->web['controller'] ) . 'Controller';
        return new $controllerClass();
    }

    public static function createName( $str ){
        $str = str_replace( "-", " ", $str );
        $str = str_replace( "_", " ", $str );
        $str = ucwords( $str );
        return str_replace( " ", "", $str );
    }

    public function runAction( $actionId, $params = [] ){
        $action = self::createname( $actionId );

        if( method_exists( $this, $action ) ){
            return $this->$action( $params );
        } else {
            $defaultController = self::getDefaultController();
            return $defaultController->runError( new \Exception( "Action $action does not exist", 404 ) );
        }
    }

    public function runError( $exception ){
        $defaultController = $this->getDefaultController();
        if( method_exists($this, 'actionError') ){
            return $this->actionError( $exception );
        } else if( method_exists( $defaultController, 'actionError' ) ){
            return $defaultController->actionError( $exception );
        } else {
            echo 'action error does not exist'; exit();
        }

    }
}
?>
