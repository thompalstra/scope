<?php
namespace common\models;

use scope\base\DataProvider;

class Page extends \scope\base\Model{

    public static function getTableName(){
        return "page";
    }

    public function rules(){
        return [
            [['url'], 'required'],
            [['url'], 'string', 'match' => '/^\/.{1,255}$/', 'hint' => '/contact, /my-page, /about-us/team/david']
        ];
    }

    public function attributeLabels(){
        return [
            'url' => 'Page url',
            'name' => 'Page title'
        ];
    }
    public function attributeDescriptions(){
        return [
            'url' => 'The url of this page',
            'name' => 'The name of this page'
        ];
    }
    public function getHtml(){
        $pageContent = $this->content;

        // matches widgets
        preg_match_all( "/<widget.*>(.*)<\/widget>/", $pageContent, $matches );
        foreach( $matches[0] as $index => $match ){
            $inner = str_replace( ['<br>', '<br/>'], ['', ''], $match);
            $inner = iconv("UTF-8", "UTF-8//IGNORE", preg_replace('/\s\s+/', '', $inner, -1, $count) );

            preg_match( '/<widget.*>(.*)<\/widget>/', $inner, $_match );
            if(isset($_match[1])){
                $attributes = json_decode($_match[1], true);
            } else {
                $attributes = [];
            }

            preg_match( '/sc-widget-class="(.*?)"/', $matches[0][$index], $match );

            $class = $match[1];
            if( class_exists( $class ) ){
                $pageContent = str_replace( $matches[0][$index] , $class::widget($attributes), $pageContent );
            }
        }
        return $pageContent;
    }

}
?>
