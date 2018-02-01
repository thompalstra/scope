<?php
namespace frontend\controllers\user;

class AboutController extends \scope\web\Controller{
    public function actionError( $exception ){
        return $this->render('error', [
            'exception' => $exception
        ]);
    }

    public function actionDetail(){
        return $this->render('detail');
    }
}
?>
