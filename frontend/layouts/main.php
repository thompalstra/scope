<?php
use scope\Html;
use common\web\assets\CommonBundle;
$this->registerBundle( CommonBundle::className() );
?>
<html>
    <head>
        <?=$this->head()?>
    </head>
    <body>
        <nav class='flow center nav'>
            <ul class='nav list'>
                <li class='nav item pull-left'>
                    <a href="/">Home</a>
                </li>
                <li class='nav item pull-left'>
                    <a href="/contact">Contact</a>
                </li>
                <li class='nav item pull-left'>
                    <a href="/blog">Blog</a>
                </li>
                <li class='nav item dropdown pull-left'>
                    <label>More</label>
                    <ul class='nav list pull-left'>
                        <li class='nav item pull-left'>
                            <a href="/newsletter">Newsletter</a>
                        </li>
                        <li class='nav item pull-left'>
                            <a href="/support">Support dsasd asda asd us</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <?=$view?>
        <footer class='col xs12 footer'>
            <p>Made by <?=Html::a( Scope::$environment->params['companyName'], [
                'href' => Scope::$environment->params['companyEmail']
            ] )?></p>
        </footer>
    </body>
    <?=$this->footer()?>
</html>
