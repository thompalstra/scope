<?php
namespace scope\base;

use scope\base\exceptions\ScopeException;

class Environment extends \scope\base\Base{


    public $name;
    public $viewPath;
    public $controllerPath;

    public function rules(){
        return [
            [['name'], 'string'],
            [['viewPath', 'controllerPath'], 'dir'],
            [['web'], 'array']
        ];
    }

    public static function fromHost( $httpHost ){
        $env =                  new self();
        $env->name =            self::getName( $httpHost );
        $env->viewPath =        self::getViewPath( $httpHost );
        $env->controllerPath =  self::getControllerPath( $httpHost );


        $env->loadConfigurations( [ 'common', $env->name ] );
        $env->loadDbConfig( $env->name );

        if( !$env->validate() ){
            foreach( $env->getErrors() as $attributes => $messages ){
                throw new ScopeException( $messages, 500 );
            }
        }
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
    public function loadConfigurations( $names = [] ){
        foreach( $names as $name ){
            $paths = [
                \Scope::$context->path . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'settings.php',
                \Scope::$context->path . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'params.php',
            ];

            foreach( $paths as $path ){
                if( file_exists( $path ) ){
                    foreach( include( $path ) as $k => $v ){
                        $this->$k = $v;
                    }
                }
            }
        }
    }

    public function loadDbConfig( $name ){
        $path = \Scope::$context->path . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'db.php';
    }
}
?>
