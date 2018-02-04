<?php
use scope\Html;
use common\web\assets\CommonBundle;
use common\web\assets\ScopeBundle;

$this->registerBundles( ScopeBundle::className(), CommonBundle::className() );
?>
<html>
    <head>
        <?=$this->head()?>
    </head>
    <body loading>
        <nav class='body nav'>
            <ul class='nav list'>
                <li class='nav item pull-left' sc-on='click' sc-for='#sidebar' sc-event='toggle'>
                    <i class="material-icons" icon>menu</i>
                </li>
                <li class='nav item dropdown pull-right'>
                    <label>Profile</label>
                    <ul class='nav list pull-left'>
                        <li class='nav item pull-left'>
                            <a href="/newsletter">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class='body sidebar'>
            <ul id='sidebar' class='sidebar list' hide>
                <li sc-event='toggle' sc-on='click' sc-for='#sidebar'><i class="material-icons" icon>close</i></li>
                <li>Manage
                    <ul>
                        <li><a href="/manage/pages">Pages</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <?=$view?>
        <?=$this->footer()?>
        <script>
            Scope.widgets();
        </script>
    </body>

</html>
