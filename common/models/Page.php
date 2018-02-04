<?php
namespace common\models;

class Page extends \scope\base\Model{
    public static function getTableName(){
        return "page";
    }
    public function getPageModules(){
        return \Scope::query()->from( PageModule::classname() )->where([
            'is_deleted' => 0
        ]);
    }
}
?>
