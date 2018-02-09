<?php
namespace scope\web;

use common\models\Page;

class Url extends \scope\core\Base implements UrlInterface{
    public function parse( $request, Array $get ){
        return $this->handle( [$request, $get] );
    }
    function handle( Array $route ){
        return $route;
    }
}

?>
