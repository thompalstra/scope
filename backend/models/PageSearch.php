<?php
namespace backend\models;
class PageSearch extends \common\models\Page{

    public $searchValue;

    public function rules(){
        return [
            [['searchValue'], 'safe']
        ];
    }

    public function searchIndex( $params ){
        $query = \Scope::query()->from( self::className() );
        return new \scope\base\DataProvider([
            'data' => $query,
            'pagination' => [
                'page' => 1,
                'pageSize' => 10
            ]
        ]);
    }
}

?>
