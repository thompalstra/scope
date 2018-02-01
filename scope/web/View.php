<?php
namespace scope\web;

use Scope;
use scope\Html;

use scope\base\exceptionsScopeException;

class View extends Scope\core\Base{

    const POS_HEAD = 'head';
    const POS_FOOTER = 'footer';

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

    public $assets = [
        'head' => [],
        'footer' => []
    ];

    public function registerJsFile( $js, $position = self::POS_HEAD ){
        $this->assets[$position][] = Html::script('', [
            'src' => $js
        ]);
    }
    public function registerCssFile( $css, $position = self::POS_HEAD ){
        $this->assets[$position][] = Html::link('', [
            'href' => $css,
            'rel' => 'stylesheet'
        ]);
    }
    public function registerJs( $js, $position = self::POS_FOOTER ){
        $this->assets[$position][] = Html::script($js);
    }
    public function registerCss( $css, $position = self::POS_HEAD ){
        $this->assets[$position][] = Html::style($css);
    }

    public function registerBundle( $bundle ){
        foreach( $bundle::getJs() as $i => $js ){
            if( is_array( $js ) ){
                $file = $i;
                $pos = ( isset( $js['position'] ) ? $js['position'] : null );
            } else {
                $file = $js;
                $pos = self::POS_HEAD;
            }
            $this->registerJsFile( $file, $pos );
        }
        foreach( $bundle::getCss() as $i => $css ){
            if( is_array( $css ) ){
                $file = $i;
                $pos = ( isset( $css['position'] ) ? $css['position'] : null );
            } else {
                $file = $css;
                $pos = self::POS_HEAD;
            }
            $this->registerCssFile( $file, $pos );
        }
    }

    public function head(){
        foreach( $this->assets[self::POS_HEAD] as $asset ){
            echo $asset;
        }
    }
    public function footer(){
        foreach( $this->assets[self::POS_FOOTER] as $asset ){
            echo $asset;
        }
    }
}
