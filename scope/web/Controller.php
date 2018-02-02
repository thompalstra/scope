<?php
namespace scope\web;

use Scope;

use scope\web\View;

use scope\base\exceptionsScopeException;
use scope\base\exceptions\HtmlException;

class Controller extends Scope\core\Base{

    public $layout;

    public function render( $viewId, $data = [] ){
        $view = new View();
        $layoutId = ( empty( $this->layout ) ? Scope::$environment->web['layout'] : $this->layout );
        return $view->render( $viewId, $layoutId, $data );
    }
    public function renderPartial( $viewId, $data = [] ){

    }

    public static function parse( $request_uri ){
        return [$request_uri, $_GET];
    }
    public static function handle( $route ){
        $request_uri = trim( $route[0], '/' );
        if( strpos( $request_uri, '?' ) !== false ){
            $request_uri = substr( $request_uri, 0, strpos( $request_uri, '?' ) );
        }

        $params = $route[1];



        $parts = explode('/', $request_uri);

        $actionId = null;
        $controllerId = null;
        $path = null;

        if( count( $parts ) > 0 && !empty( $parts[ count( $parts ) -1 ] ) ){
            $actionId = $parts[ count( $parts ) -1 ];
            array_pop( $parts );
        } else {
            $actionId = Scope::$environment->web['action'];
        }

        if( count( $parts ) > 0 && !empty( $parts[ count( $parts ) -1 ] ) ){
            $controllerId = $parts[ count( $parts ) -1 ];
            array_pop( $parts );
        } else {
            $controllerId = Scope::$environment->web['controller'];
        }

        if( count( $parts ) > 0 && !empty( $parts[0] ) ){
            $path = implode( DIRECTORY_SEPARATOR, $parts ) . DIRECTORY_SEPARATOR;
        }

        $controller = self::createName( $controllerId ) . 'Controller';

        $controllerClass =  Scope::$environment->name . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $path . $controller;
        $viewPath = $path . $controllerId . DIRECTORY_SEPARATOR;

        if( !class_exists( $controllerClass ) ){
            $defaultController = self::getDefaultController();
            return $defaultController->runError( new HtmlException("Page not found", 404 ) );
        }

        $c = new $controllerClass([
            'actionId' => $actionId,
            'controllerId' => $controllerId,
            'viewPath' => $viewPath,
        ]);

        return $c->runAction( $c->actionId );
    }

    public static function getDefaultController(){
        $controllerClass = Scope::$environment->name . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . self::createName( Scope::$environment->web['controller'] ) . 'Controller';

        $controllerId = Scope::$environment->web['controller'];
        $actionId = Scope::$environment->web['action'];

        $viewPath = $controllerId . DIRECTORY_SEPARATOR;
        $controllerPath = Scope::$environment->viewPath . $controllerId . '.php';

        return new $controllerClass([
            'actionId' => $actionId,
            'controllerId' => $controllerId,
            'viewPath' => $viewPath,
        ]);
    }

    public static function createName( $str ){
        $str = str_replace( "-", " ", $str );
        $str = str_replace( "_", " ", $str );
        $str = ucwords( $str );
        return str_replace( " ", "", $str );
    }

    public function runAction( $actionId, $params = [] ){

        Scope::$controller = $this;



        $action = 'action' . self::createname( $actionId );
        if( method_exists( $this, $action ) ){
            return call_user_func_array( [$this, $action], $params );
        } else {
            $defaultController = self::getDefaultController();
            return $defaultController->runError( new HtmlException( "Page not found", 404 ) );
        }
    }

    public function runError( $exception ){
        $defaultController = $this->getDefaultController();
        Scope::$statusCode = Scope::STATUS_CODE_HTML_EXCEPTION;
        if( method_exists($this, 'actionError') ){
            return $this->runAction( 'error', [$exception] );
        } else if( method_exists( $defaultController, 'actionError' ) ){
            return $defaultController->runAction( 'error', [$exception] );
        } else {
            echo 'action error does not exist'; exit();
        }

    }
}
?>
