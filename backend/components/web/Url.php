<?php
namespace backend\components\web;

use common\models\Page;

class Url extends \scope\core\Base implements \scope\web\UrlInterface{
    public function parse( $request, Array $get ){
        return $this->handle( [$request, $get] );
    }
    function handle( Array $route ){
        return $route;
    }
}

?>
