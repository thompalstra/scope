<?php
namespace backend\controllers\manage;

class PagesController extends \scope\web\Controller{
    public function actionIndex(){
        return $this->render('index');
    }
}
