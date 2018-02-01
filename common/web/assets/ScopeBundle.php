<?php
namespace common\web\assets;
class CommonBundle extends \scope\web\Bundle{
    public static function getJs(){
        return [
            '/web/assets/scope/scope.core.js',
        ];
    }
    public static function getCss(){
        return [];
    }
    public static function getDepends(){
        return [];
    }
}
?>
