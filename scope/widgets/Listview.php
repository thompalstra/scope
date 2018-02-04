<?php
namespace scope\widgets;

use scope\Html;
use scope\web\View;

class Listview extends \scope\widgets\Widget{

    public $dataProvider;

    public $options = [
        'class' => 'listview'
    ];
    public $itemOptions = [
        'class' => 'item'
    ];

    public function prepare( $params = [] ){
        foreach( $params as $k => $v ){
            $this->$k = $v;
        }

        if(empty($this->options['id']) ){
            $this->options['id'] = \Scope::uid();
        }
    }
    public function run(){
        return $this->begin( $this->options ) . $this->items( $this->itemOptions ) . $this->end();
    }

    public function begin( $options ){
        return Html::open( 'div', $options );
    }
    public function items( $options ){
        $items = [];
        foreach( $this->dataProvider->getData() as $data ){
            var_dump($data);
            $items[] = $this->item( $data );
        }
        return implode( "", $items );
    }

    public function item( $data ){
        $view = new View();
        return $view->renderFile( View::getViewPath( $this->view ), [
            'data' => $data
        ] );
    }

    public function end(){
        return Html::close( 'div' );
    }
}
?>
