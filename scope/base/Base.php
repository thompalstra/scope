<?php
namespace scope\base;

use scope\base\validation\Rule;

class Base{

    public $_errors = [];
    public $_attributes = [];
    public $_oldAttributes = [];


    public function load(){

    }
    public function rules(){

    }

    public function validate(){
        foreach( $this->rules() as $rule ){
            Rule::validate( $rule, $this );
        }
    }
    public function validateRule( $rule ){

    }

    public function addError( $attribute, $message ){
        if( !isset( $this->_errors[$attribute] ) ){
            $this->_errors[$attribute] = [];
        }
        $this->_errors[$attribute][] = $message;
    }
    public function getErrors(){
        return $this->_errors;
    }
}

?>
