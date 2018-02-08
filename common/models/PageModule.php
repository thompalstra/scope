<?php
namespace common\models;

use scope\Html;

class PageModule extends \scope\base\Model{

    public static function getTableName(){
        return "page_module";
    }

    public function rules(){
        return [
            [['classname'], 'required'],
        ];
    }
}
?>
