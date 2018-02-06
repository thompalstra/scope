<?php
namespace scope\widgets;

use scope\Html;
use scope\widgets\FormField;

class Form extends \scope\widgets\Widget{

    public $options = [
        'class' => 'form'
    ];
    public $rowOptions = [
        'class' => 'form row col xs12'
    ];
    public $labelOptions = [
        'class' => 'form label'
    ];
    public $inputOptions = [
        'class' => 'form input'
    ];
    public $hintOptions = [
        'class' => 'form hint'
    ];
    public $errorOptions = [
        'class' => 'form error'
    ];

    public $template = "{rowOpen}{label}{input}{hint}{error}{rowClose}";

    public function prepare( $params = [] ){
        foreach( $params as $k => $v ){
            $this->$k = $v;
        }
    }
    public function run(){

    }
    public function field( $model, $attribute ){
        return new FormField([
            'model' => $model,
            'attribute' => $attribute,
            'form' => $this
        ]);
    }
    public function open( $options ){
        return Html::open('form', $options);
    }
    public function close(){
        return Html::close('form');
    }
}

?>
