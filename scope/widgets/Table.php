<?php
namespace scope\widgets;

use scope\Html;

class Table extends \scope\widgets\Widget{

    public $dataProvider;

    public $options = [
        'class' => 'table'
    ];
    public $cellOptions = [
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
        return $this->begin( $this->options ) . $this->items( $this->cellOptions ) . $this->end();
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

            $rowOptions = Html::attr( ( isset( $this->rowOptions ) ) ? $this->rowOptions : [] );

            preg_match_all( '/{(.*)}/', $rowOptions, $matches ) ;
            foreach( $matches[1] as $match ){
                if( property_exists( $data, $match ) ){
                    $value = $data->$match;
                    $rowOptions = str_replace( "{{$match}}", "$value", $rowOptions );
                }
            }

            $out .= Html::open('tr', $rowOptions);
            foreach( $columns as $column ){
                $cellOptions = $this->cellOptions;
                if( isset( $column['cellOptions'] ) ){
                    foreach( $column['cellOptions'] as $k => $v ){
                        $cellOptions[$k] = $v;
                    }
                }

                $out .= Html::open('td', $cellOptions );
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
