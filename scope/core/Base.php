<?php
namespace scope\core;

use scope\base\validation\Rule;

class Base{
    public $_hints = [];
    public $_errors = [];
    public $_attributes = [];
    public $_oldAttributes = [];

    public function __construct( $args = []){
        foreach( $args as $k => $v){
            $this->$k = $v;
        }

        foreach( $this as $k => $v ){
            if( $k[0] == '_' || strtolower($k) == 'isnewrecord' ){
                continue;
            }
            $this->_oldAttributes[$k] = $this->_attributes[$k] = $v;
            $this->$k = &$this->_attributes[$k];
        }
    }

    public static function className(){
        return get_called_class();
    }

    public static function subClassName(){
        $className = self::className();
        $parts = explode('\\', $className);
        return $parts[ count($parts) -1 ];
    }


    public function load( $params = [] ){

        if( isset( $params[ self::subClassName() ] ) ){
            foreach( $params[ self::subClassName() ] as $k => $v ){
                $this->$k = $v;
            }
            return true;
        } else {
            return false;
        }
    }
    public function attributeDescriptions(){ return []; }
    public function rules(){ return []; }

    public function validate(){
        foreach( $this->rules() as $rule ){
            Rule::validate( $rule, $this );
        }

        if( count( $this->_errors ) > 0 ){
            return false;
        } else {
            return true;
        }
    }

    public function addError( $attribute, $message ){
        if( !isset( $this->_errors[$attribute] ) ){
            $this->_errors[$attribute] = [];
        }
        $this->_errors[$attribute][] = $message;
    }
    public function addHint( $attribute, $message ){
        if( !isset( $this->_hints[$attribute] ) ){
            $this->_hints[$attribute] = [];
        }
        $this->_hints[$attribute][] = $message;
    }
    public function getErrors( $attribute = null ){
        if( $attribute ){
            if( isset( $this->_errors[$attribute] ) ){
                return $this->_errors[$attribute];
            }
            return [];

        } else {
            return $this->_errors;
        }
    }
    public function getHints( $attribute = null ){
        if( $attribute ){
            if( isset( $this->_hints[$attribute] ) ){
                return $this->_hints[$attribute];
            }
            return [];

        } else {
            return $this->_hints;
        }
    }

    public function attributeLabels(){
        return [];
    }

    public function getAttributeLabel( $attribute ){
        $attributeLabels = $this->attributeLabels();
        if( isset( $attributeLabels[$attribute] ) ){
            return $attributeLabels[$attribute];
        } else {
            return self::createAttributeLabel( $attribute );
        }
    }

    public function getAttributeDescription( $attribute ){
        $attributeDescriptions = $this->attributeDescriptions();
        if( isset( $attributeDescriptions[$attribute] ) ){
            return $attributeDescriptions[$attribute];
        } else {
            return self::createAttributeLabel( $attribute );
        }
    }

    public static function createAttributeLabel( $attribute ){
        $attribute = str_replace( ['_', '-', '[', ']'], [' ', ' ', ' ', ' '], $attribute );
        $attribute = ucwords( $attribute );
        $attribute = str_replace( [' '], [''], $attribute );
        return $attribute;
    }

}

?>
