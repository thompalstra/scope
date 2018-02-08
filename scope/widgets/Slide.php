<?php
namespace scope\widgets;

use scope\Html;

class Slide extends \scope\widgets\Widget{

    public $options = [
        'class' => 'scope slide'
    ];
    public $wrapperOptions = [
        'class' => 'wrapper'
    ];
    public $itemOptions = [
        'class' => 'scope item'
    ];

    public function prepare( $args ){

        foreach( $args as $k => $v ){
            $this->$k = $v;
        }

        if(empty( $this->options['id'] ) ){
            $this->options['id'] = \Scope::uid();
        }

        $this->options['widget'] = '';
        $this->options['widget-state'] = 'pending';
        $this->options['widget-class'] = 'scope.slide';

        $out = $this->open();
        $out .= $this->items( $this->items );

        $this->html = $this->open() . $this->items( $this->items ) . $this->close();
    }

    public function open(){
        return Html::open( 'widget', $this->options );
    }
    public function items( $items ){
        $out = Html::open( 'div', $this->wrapperOptions);
        $out .= Html::open( 'ul' );
        foreach( $items as $item ){
            $options = $this->itemOptions;
            $options['style']['background-image'] = "url( " . $item['img'] . ")";
            $out .= Html::li('', $options);
        }
        $out .= Html::close( 'ul' );
        $out .= Html::close( 'div' );
        return $out;
    }
    public function close(){
        return Html::close( 'widget' );
    }

    public function run(){
        return $this->html;
    }
}
