<?php
spl_autoload_register(function ($class) {
    if( file_exists( __DIR__ . DIRECTORY_SEPARATOR . $class . '.php') ){
        include( __DIR__ . DIRECTORY_SEPARATOR . $class . '.php' );
    }
});
?>
