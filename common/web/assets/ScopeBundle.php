<?php
namespace common\web\assets;
class ScopeBundle extends \scope\web\Bundle{
    public static function getJs(){
        return [
            'http://scope.js/latest/scope.core.js',
            'http://scope.js/latest/scope.slide.js',
        ];
    }
    public static function getCss(){
        return [
            'http://scope.js/latest/scope.core.css',
            'http://scope.js/latest/scope.slide.css',
        ];
    }
    public static function getDepends(){
        return [];
    }
}
?>
