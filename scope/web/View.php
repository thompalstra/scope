<?php
namespace scope\web;

use Scope;

use scope\base\exceptionsScopeException;

class View extends Scope\core\Base{
    public function render( $viewId, $layoutId, $data ){

        if( $viewId[0] == '/' ){
            $viewPath = Scope::$context->path . $viewId . '.php' ;
        } else {
            $viewPath = Scope::$environment->viewPath . Scope::$controller->viewPath . $viewId . '.php' ;
        }

        if( $layoutId[0] == '/' ){
            $layoutPath = Scope::$context->path . $layoutId . '.php' ;
        } else {
            $layoutPath = Scope::$environment->layoutPath . $layoutId . '.php' ;
        }

        $viewPath   =   self::getViewPath( $viewId );
        $layoutPath =   self::getLayoutPath( $layoutId );

        echo $this->renderFile( $layoutPath, [
            'view' =>  $this->renderFile( $viewPath, $data )
        ]);
        return Scope::$statusCode;
    }

    public function renderFile( $file, $data = [] ){
        $file = self::getFilePath( $file );
        extract($data, EXTR_PREFIX_SAME, 'data');
        ob_start();
        require($file);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    public function getFilePath( $file ){
        return Scope::$context->path . $file;
    }

    public static function getViewPath( $id ){
        if( $id[0] == '/' ){
            return $id . '.php' ;
        } else {
            return Scope::$environment->viewPath . Scope::$controller->viewPath . $id . '.php' ;
        }
    }

    public static function getLayoutPath( $id ){
        if( $id[0] == '/' ){
            return $id . '.php' ;
        } else {
            return DIRECTORY_SEPARATOR . Scope::$environment->layoutPath . $id . '.php' ;
        }
    }
}
