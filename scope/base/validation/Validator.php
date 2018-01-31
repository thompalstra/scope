<?php
namespace scope\base\validation;

class Validator{
    public function asString( $attribute, $context ){
        $value = $context->$attribute;
        if( !is_string( $value ) ){
            $context->addError($attribute, "$attribute is not a string");
        }
    }
    public function asArray( $attribute, $context ){
        $value = $context->$attribute;
        if( !is_array( $value ) ){
            $context->addError($attribute, "$attribute is not an array");
        }
    }
    public function asDir( $attribute, $context ){
        $value = $context->$attribute;
        if( !is_dir( $value ) ){
            $context->addError($attribute, "$attribute is not directory");
        }
    }
}
?>
