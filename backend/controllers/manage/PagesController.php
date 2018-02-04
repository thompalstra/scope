<?php
namespace backend\controllers\manage;

use common\models\Page;

class PagesController extends \scope\web\Controller{
    public function actionView(){

        $model = $this->find( $_GET['id'] );
        var_dump($model);
        return $this->render('view', [
            'model' => $model
        ]);
    }
    public function find( $id ){
        $model = \Scope::query()->from( Page::className() )->where([
            'id' => $id
        ])->one();

        if( empty( $model ) ){
            \Scope::$controller->runError( new \Exception('dsadas') );
        } else {
            return $model;
        }
    }
}
