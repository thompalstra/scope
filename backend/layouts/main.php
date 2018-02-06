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
            <div id='sidebar' class='sidebar wrapper' hide>
                <div class='sidebar backdrop'></div>
                <ul class='sidebar list'>
                    <li sc-event='toggle' sc-on='click' sc-for='#sidebar'>
                        <span>
                            <i class="material-icons" icon>close</i>
                        </span>
                    </li>
                    <li class='nav item' sc-on='click' sc-for='#sidebar' sc-event='toggle'>
                        <a href="/">
                            <i class="material-icons" icon>dashboard</i> Dashboard
                        </a>
                    </li>
                    <li hide sc-event='toggle' sc-on='click'>
                        <span>
                            <i class="material-icons" icon>data_usage</i> Manage
                        </span>
                        <ul>
                            <li>
                                <a href="/manage/pages"><i class="material-icons" icon>view_compact</i> Pages</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <?=$view?>
        <?=$this->footer()?>
        <script>
            Scope.widgets();
        </script>
    </body>

</html>
