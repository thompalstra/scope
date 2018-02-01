<?php
namespace frontend\controllers;

class SiteController extends \scope\web\Controller{
    public function actionError( $exception ){
        return $this->render('error', [
            'exception' => $exception
        ]);
    }

    public function actionIndex(){
        return $this->render('index');
    }
    public function actionContact(){
        return $this->render('contact');
    }
}
?>
