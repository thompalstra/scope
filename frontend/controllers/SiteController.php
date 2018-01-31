<?php
namespace frontend\controllers;

class SiteController extends \scope\web\Controller{
    public function actionError( $exception ){
        return $this->render('error', [
            'exception' => $exception
        ]);
    }
}
?>
