<?php
namespace scope\base\exceptions;

class HtmlException extends \Exception{
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        $message = ( is_array( $message ) ) ?  implode("<br/>", $message) : $message;
        parent::__construct($message, $code, $previous);
    }

}
