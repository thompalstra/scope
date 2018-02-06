<?php
namespace backend\controllers\manage;

use common\models\Page;

use scope\base\exceptions\HtmlException;

class PagesController extends \scope\web\Controller{
    public function actionView(){

        if( $model = $this->find( $_GET['id'] ) ){
            if( $_POST && $model->load($_POST) && $model->validate() ){
                $model->save();
            }
            return $this->render('view', [
                'model' => $model
            ]);
        }

    }
    public function find( $id ){

        $model = \Scope::query()->from( Page::className() )->where([
            'and',
            ['is_deleted' => 0]
        ])->one();

        if( empty( $model ) ){
            return \Scope::$controller->runError( new HtmlException('dsadas') );
        } else {
            return $model;
        }
    }
}
