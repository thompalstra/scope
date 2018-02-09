<?php
namespace frontend\controllers;

class PageController extends \scope\web\Controller{
    public function actionView(){
        return $this->render('view');
    }
}

?>
