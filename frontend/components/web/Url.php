<?php
namespace frontend\components\web;

use common\models\Page;

class Url extends \scope\core\Base implements \scope\web\UrlInterface{
    public function parse( $request, Array $get ){
        return $this->handle( [$request, $get] );
    }
    function handle( Array $route ){
        $url = $route[0];
        $page = \Scope::query()->from( Page::className() )->where([
            'and',
            ['LIKE', 'url', "%$url%"]
        ])->one();

        if( $page ){
            \Scope::$context->page = $page;
            return [ '/page/view', $route[1] ];
        }
        return $route;
    }
}

?>
