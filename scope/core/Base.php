<?php
namespace scope\core;

use scope\base\validation\Rule;

class Base{

    public $_errors = [];
    public $_attributes = [];
    public $_oldAttributes = [];

    public function __construct( $args = [] ){
        foreach( $args as $k => $v){
            $this->$k = $v;
        }
    }

    public static function className(){
        return get_called_class();
    }


    public function load( $params = [] ){

        if( isset( $params[ self::className() ] ) ){
            foreach( $params[ self::className() ] as $k => $v ){
                $this->$k = $v;
            }
            return true;
        } else {
            return false;
        }
    }


    public function rules(){    return [];  }

    public function validate(){
        foreach( $this->rules() as $rule ){
            Rule::validate( $rule, $this );
        }
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
