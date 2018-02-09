<?php
namespace scope\web;

interface UrlInterface{
    public function parse( $request, Array $get );
    function handle( Array $route );
}
?>
