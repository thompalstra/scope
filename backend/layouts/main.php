<?php
use scope\Html;
?>
<html>
    <head>
        <?=$this->head?>
    </head>
    <body>
        <section class='wrapper center header'>

        </section>
        <section class='wrapper center body'>
            <?=$view?>
        </section>
        <footer class='wrapper center footer'>
            <p>Made by <?=Html::a( Scope::$environment->params['companyName'], [
                'href' => Scope::$environment->params['companyEmail']
            ] )?></p>
        </footer>
    </body>
    <?=$this->footer?>
</html>
