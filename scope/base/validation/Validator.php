<?php
namespace scope\base\validation;

class Validator{
    public function asString( $attribute, $context, $options = [] ){
        $value = $context->$attribute;

        if( isset($options['hint']) ){
            $context->addHint($attribute, $options['hint']);
        }

        if( !is_string( $value ) ){
            $context->addError($attribute, "$attribute is not a string");
        }

        if( isset($options['match']) ){
            if( !preg_match( $options['match'], $value ) ){
                $context->addError($attribute, "$attribute does not match given pattern");
            }

        }
    }
    public function asArray( $attribute, $context, $options = [] ){
        $value = $context->$attribute;

        if( isset($options['hint']) ){
            $context->addHint($attribute, $options['hint']);
        }

        if( !is_array( $value ) ){
            $context->addError($attribute, "$attribute is not an array");
        }
    }
    public function asDir( $attribute, $context, $options = [] ){
        $value = $context->$attribute;

        if( isset($options['hint']) ){
            $context->addHint($attribute, $options['hint']);
        }

        if( !is_dir( $value ) ){
            $context->addError($attribute, "$attribute is not directory");
        }
    }
    public function asRequired( $attribute, $context, $options = [] ){
        $value = $context->$attribute;
        if( isset($options['hint']) ){
            $context->addHint($attribute, $options['hint']);
        }

        if( empty( $value ) || $value === null || $value === '' ){
            $context->addError($attribute, "$attribute is required");
        }
    }
}
?>
