<?php
namespace common\models;

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

    public function getPageModules(){
        return \Scope::query()->from( PageModule::classname() )->where([
            'is_deleted' => 0
        ]);
    }
}
?>
