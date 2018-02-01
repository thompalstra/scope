<?php
namespace scope;

class Html{
    public function __call( $a, $b ){

        $b[1] = isset( $b[1] ) ? $b[1] : [];

        return call_user_func_array( [ get_called_class(), 'call' ], [ $a, $b[0], $b[1] ] );
    }
    public static function __callStatic(  $a, $b  ){

        $b[1] = isset( $b[1] ) ? $b[1] : [];

        return call_user_func_array( [ get_called_class(), 'call' ], [ $a, $b[0], $b[1] ] );
    }

    public static function call( $tagName, $content, $options ){
        return self::open( $tagName, $options ) . $content . self::close( $tagName );
    }

    public static function attr( $options = [], $inner = false ){
        $lines = [];
        foreach( $options as $key => $val ){
            if( is_array( $val ) ){

                $lines[] = $key . '="' . self::styleAttr( $val ) . '"';
            } else {
                $lines[] = $key . '="' . $val . '"';
            }
        }

        return implode( " ", $lines );
    }

    public static function styleAttr( $options ){
        foreach( $options as $key => $val ){
            if( !is_array( $val ) ){
                $lines[] = "$key:$val;";
            }
        }
        return implode( " ", $lines );
    }

    public static function open( $tagName, $options = [] ){
        $attr = self::attr( $options );
        return "<$tagName $attr>";
    }
    public static function close( $tagName ){
        return "</$tagName>";
    }
}

?>
