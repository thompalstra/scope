<?php
namespace scope\widgets;

class Widget extends \scope\core\Base{

    public function prepare(){}
    public function run(){}

    public static function widget( $params ){
        $className = self::className();
        $widget = new $className();
        $widget->prepare( $params );
        return $widget->run();
    }
}
?>
