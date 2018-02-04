<?php
namespace common\web\assets;

use common\web\assets\ScopeBundle;
use scope\web\View;

class CommonBundle extends \scope\web\Bundle{
    public static function getJs(){
        return [
            '/web/assets/script/script.js' => [
                'position' => View::POS_FOOTER
            ],
            '/web/script/script.js' => [
                'position' => View::POS_FOOTER
            ]
        ];
    }
    public static function getCss(){
        return [
            '/web/assets/style/style.css',
            '/web/style/style.css'
        ];
    }
}
?>
