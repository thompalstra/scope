<?php
namespace backend\controllers;

use backend\models\PageSearch;

use common\models\Page;
use common\models\User;

class ManageController extends \scope\web\Controller{
    public function actionPages(){
        $searchModel = new PageSearch();
        $searchModel->load( $_GET );
        $dataProvider = $searchModel->searchIndex( $_GET );

        return $this->render('pages', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionUsers(){
        $searchModel = new SearchModel( User::className(), $_GET );
        return $this->render('users');
    }
}
