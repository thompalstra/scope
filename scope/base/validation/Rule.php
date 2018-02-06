<?php
namespace scope\base\validation;

use scope\base\validation\Validator;

class Rule{
    public static function validate( $rule, $context ){
        $validator = new Validator();

        $attributes = $rule[0];
        array_shift( $rule );
        $validatorMethod = $rule[0];
        array_shift( $rule );
        $options = $rule;

        $m = null;
        $v = null;

        if( method_exists( $context, $validatorMethod ) ){
            $m = $context;
            $v = $validatorMethod;
        } else {
            $m = $validator;
            $v = 'as' . ucwords( $validatorMethod );
        }

        foreach( $attributes as $attribute ){
            $m->$v( $attribute, $context, $options );
        }
    }
}
?>
