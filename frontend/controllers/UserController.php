<?php
namespace frontend\controllers;

class UserController extends \scope\web\Controller{
    public function actionError( $exception ){
        return $this->render('error', [
            'exception' => $exception
        ]);
    }

    public function actionHome(){
        return $this->render('home');
    }
}
?>
