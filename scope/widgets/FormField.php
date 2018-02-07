<?php
namespace scope\widgets;

use scope\Html;
use scope\core\Base;

class FormField extends \scope\widgets\Widget{
    public function input( $opt ){
        $template = $this->form->template;
        $template = str_replace( '{rowOpen}', $this->rowOpen( $this->form->rowOptions ), $template );
        $template = str_replace( '{wrapperOpen}', $this->wrapperOpen( $opt ), $template );
        $template = str_replace( '{wrapperClose}', $this->wrapperClose(), $template );
        $template = str_replace( '{label}', $this->createLabel( $this->form->labelOptions ), $template );
        $template = str_replace( '{input}', $this->createInput( $opt ), $template );
        $template = str_replace( '{hint}', $this->createHint( $this->form->hintOptions ), $template );
        $template = str_replace( '{error}', $this->createError( $this->form->errorOptions ), $template );
        $template = str_replace( '{rowClose}', $this->rowClose(), $template );
        return $template;
    }

    public function createInput( $opt ){
        $options = $this->form->inputOptions;

        foreach( $opt as $k => $v ){
            $options[$k] = $v;
        }

        $options['name'] = self::createInputName();
        $options['value'] = self::createInputValue();

        return  Html::open( 'input', $options ) . Html::close( 'input' );
    }

    public function wrapperOpen( $wrapper ){
        $options = $this->form->wrapperOptions;
        $wrapper = ( isset( $wrapper['wrapperOptions'] ) ? $wrapper['wrapperOptions'] : [] );

        foreach( $options as $k => $v ){
            $options[$k] = $v;
        }

        if( is_object( $this->model ) ){
            $attr = $this->attribute;
            if( count( $this->model->getHints( $attr ) ) > 0 ){
                $options['has-error'] = '';
            }
            if( count( $this->model->getErrors( $attr ) ) > 0 ){
                $options['has-hint'] = '';
            }
        } else {
            $hints = [];
            $errors = [];
        }

        return Html::open( 'div', $options );
    }
    public function wrapperClose(){
        return Html::close( 'div' );
    }

    public function createInputName(){

        if( is_object ( $this->model ) ){
            $model = $this->model;
            $base = $model::subClassName();
        } else {
            $base = $this->model;
        }

        $attr = $this->attribute;

        if( $attr[ strlen($attr) - 2 ] == '[' && $attr[ strlen($attr) -1 ] == ']' ){
            return $base . '[' . str_replace([ '[', ']' ], ['', ''], $attr) . '][]';
        }
        return $base . '[' . $attr . ']';
    }
    public function createInputValue(){
        if( is_object( $this->model ) ){
            $attr = $this->attribute;
            $model = $this->model;
            return $model->$attr;
        }
        return '';
    }

    public function rowOpen( $opt ){
        $rowOptions = $this->form->rowOptions;

        foreach( $opt as $k => $v ){
            $rowOptions[$k] = $v;
        }

        return Html::open( 'div', $rowOptions );
    }
    public function rowClose(){
        return Html::close( 'div' );
    }
    public function createLabel( $labelOptions ){
        if( is_object( $this->model ) ){
            $label = $this->model->getAttributeLabel( $this->attribute );
        } else {
            $label = Base::createAttributeLabel( $this->attribute );
        }

        return Html::label( $label, $labelOptions );
    }
    public function createHint( $hintOptions ){

        if( is_object( $this->model ) ){
            $attr = $this->attribute;
            $model = $this->model;
            $hints = $model->getHints( $attr );
            $errors = $model->getErrors();
        } else {
            $hints = [];
            $errors = [];
        }

        if( count( $errors ) > 0 && count( $hints ) > 0 ){
            return Html::open( 'div', $hintOptions ) . Html::label( implode("\n", $hints), [] ) . Html::close( 'div' );
        } else {
            return '';
        }
    }
    public function createError( $errorOptions ){
        if( is_object( $this->model ) ){
            $attr = $this->attribute;
            $model = $this->model;
            $errors = $model->getErrors( $attr );
        } else {
            $errors = [];
        }

        if( count( $errors ) > 0 ){
            return Html::open( 'div', $errorOptions ) . implode("\n", $errors) . Html::close( 'div' );
        } else {
            return '';
        }
    }
}
