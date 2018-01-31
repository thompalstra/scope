<?php
namespace scope\base\exceptions;

class ScopeException extends \Exception{
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        $message = ( is_array( $message ) ) ?  implode("<br/>", $message) : $message;
        parent::__construct($message, $code, $previous);
        ?>
        <style>
            html, body{ padding: 0; margin: 0; background-color: rgba(0,0,0,.05) }

            .exception-wrapper{
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                margin: auto;

                width: 75%;
                height: 75%;
                overflow: hidden;

                -webkit-box-shadow: 10px 10px 10px -5px rgba(0,0,0,0.6);
                -moz-box-shadow: 10px 10px 10px -5px rgba(0,0,0,0.6);
                box-shadow: 10px 10px 10px -5px rgba(0,0,0,0.6);
            }

            .exception{
                background-color: white;
                min-height: 100%;
            }

            .exception .title,
            .exception .trace,
            .exception .message{
                width: 100%;
                display: inline-block;
                float: left;
                box-sizing: border-box;
                padding: 10px;
            }
            .exception .title{
                color: white;
                background-color: red;
                margin:0;
            }

            .exception:first-child{
                margin-top: 0;
            }
            .exception:last-child{
                margin-bottom: 0;
            }

            .exception .message{
                background-color: #ddd;
            }

            .exception .trace{
                white-space: pre-wrap;
            }


        </style>
        <div class='exception-wrapper'>
            <div class='exception'>
                <h2 class='title'>
                    Uncaught error <span class='scope-code'>(<?=$this->getCode()?>)</span>
                </h2>
                <div class='message'><?=$this->getMessage()?></div>
                <div class='trace' ><?=$this->getTraceAsString()?></div>
            </div>
        </div>
        <?php
        exit();
    }
}

?>
