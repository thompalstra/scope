<?php
namespace common\models;

class Page extends \scope\base\Model{
    public static function getTableName(){
        return "page";
    }

    public function rules(){
        return [
            [['url'], 'required'],
            [['url'], 'string', 'match' => '/^\/.{1,255}$/', 'hint' => 'valid urls: /contact, /my-page, /about-us/team/david']
        ];
    }

    public function getPageModules(){
        return \Scope::query()->from( PageModule::classname() )->where([
            'is_deleted' => 0
        ]);
    }
}
?>
