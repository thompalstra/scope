<?php
use scope\widgets\Form;
use scope\Html;
?>

<div class='flow center'>
    <div class='module'>
        <?php $form = new Form([
            'rowOptions' => [
                'class' => 'form row'
            ],
        ]) ?>
        <?=$form->open([
            'id' => 'form-pages-form',
            'method' => 'POST'
        ])?>
        <?=$form->field( $model, 'url' )->input([
            'type' => 'text'
        ])?>
        <?=$form->field( 'derp', 'url[]' )->input([
            'type' => 'text'
        ]);?>
        <?=Html::button( 'send', [
            'class' => 'button submit'
        ])?>
        <?=$form->close()?>
    </div>
</div>
