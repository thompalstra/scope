<?php
namespace backend\controllers;

class SiteController extends \scope\web\Controller{
    public function actionError( $exception ){
        return $this->render('error', [
            'exception' => $exception
        ]);
    }
    public function actionIndex(){
        return $this->render('index');
    }
}
?>
