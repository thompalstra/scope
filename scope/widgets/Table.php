<?php
namespace scope\widgets;

use scope\Html;

class Table extends \scope\widgets\Widget{

    public $dataProvider;

    public $options = [
        'class' => 'table'
    ];
    public $itemOptions = [
        'class' => 'item'
    ];
    public $headerOptions = [
        'class' => 'item'
    ];

    public function prepare( $params = [] ){
        foreach( $params as $k => $v ){
            $this->$k = $v;
        }

        if(empty( $this->options['id'] ) ){
            $this->options['id'] = \Scope::uid();
        }
    }
    public function run(){
        return $this->begin( $this->options ) . $this->items( $this->itemOptions ) . $this->end();
    }
    public function begin( $options ){
        return Html::open('table', $options);
    }
    public function items( $options ){
        return $this->header( $this->columns ) . $this->rows( $this->columns );
    }
    public function header( $columns ){
        $out = [];
        $out[] = Html::open('thead');
        foreach( $columns as $column ){
            $item = Html::open('th', $this->headerOptions );
            if( isset( $column['header'] ) ){
                $item .= $column['header'];
            } else {
                $item .= $column['attribute'];
            }
            $item .= Html::close('th');

            $out[] = $item;
        }
        $out[] = Html::close('thead');
        return implode($out);
    }
    public function rows( $columns ){
        $out = Html::open('tbody');
        foreach( $this->dataProvider->getData() as $data ){

            if(isset( $this->rowUrl )){

                $url = $this->rowUrl;
                preg_match( '({.*})', $url, $matches ) ;
                foreach( $matches as $match ){
                    $attr = str_replace(['{', '}'], ['', ''], $match);
                    $value = $data->$attr;
                    $url = str_replace( $match, $value, $url );
                }

                $options = [
                    'sc-on' => 'click',
                    'sc-event' => 'navigate',
                    'sc-url' => $url
                ];
            }

            $out .= Html::open('tr', $options);
            foreach( $columns as $column ){
                $out .= Html::open('td', $this->headerOptions );
                if( isset( $column['content'] ) ){
                    $fn = $column['content'];
                    $out .= call_user_func_array( $fn, [$data] );
                } else {
                    $attr = $column['attribute'];
                    $out .= $data->$attr;
                }
                $out .= Html::close('td');
            }

            $out .= Html::close('tr');
        }
        $out .= Html::close('tbody');
        return $out;
    }
    public function end(){
        return Html::close('table');
    }
}
