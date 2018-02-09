<?php
namespace scope\widgets;

use scope\Html;
use scope\core\Base;

class FormField extends \scope\core\Base{
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
    public function widget( $className, $opt ){
        $template = $this->form->template;
        $template = str_replace( '{rowOpen}', $this->rowOpen( $this->form->rowOptions ), $template );
        $template = str_replace( '{wrapperOpen}', $this->wrapperOpen( $opt ), $template );
        $template = str_replace( '{wrapperClose}', $this->wrapperClose(), $template );
        $template = str_replace( '{label}', $this->createLabel( $this->form->labelOptions ), $template );
        $template = str_replace( '{input}', $this->createWidget( $className, $opt ), $template );
        $template = str_replace( '{hint}', $this->createHint( $this->form->hintOptions ), $template );
        $template = str_replace( '{error}', $this->createError( $this->form->errorOptions ), $template );
        $template = str_replace( '{rowClose}', $this->rowClose(), $template );
        return $template;
    }

    public function createWidget( $className, $options ){
        if( class_exists( $className ) ){

            $options['data'] = $this->model;
            $options['attribute'] = $this->attribute;

            return $className::widget($options);
        }
    }

    public function createInput( $opt ){
        $options = $this->form->inputOptions;

        foreach( $opt as $k => $v ){
            $options[$k] = $v;
        }

        $options['name'] = self::createInputName( $this->model, $this->attribute );
        $options['value'] = self::createInputValue( $this->model, $this->attribute );

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

    public static function createInputName( $model, $attribute ){

        if( is_object ( $model ) ){
            $base = $model::subClassName();
        } else {
            $base = $model;
        }

        $attr = $attribute;

        if( $attr[ strlen($attr) - 2 ] == '[' && $attr[ strlen($attr) -1 ] == ']' ){
            return $base . '[' . str_replace([ '[', ']' ], ['', ''], $attr) . '][]';
        }
        return $base . '[' . $attr . ']';
    }
    public static function createInputValue( $model, $attribute ){
        if( is_object( $model ) ){
            $attr = $attribute;
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
