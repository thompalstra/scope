<?php
use scope\widgets\Form;
use scope\Html;
?>

<div class='flow center'>
    <div class='module'>
        <?php $form = new Form([
            'rowOptions' => [
                'class' => 'form row col xs12'
            ],
            'labelOptions' => [
                'class' => 'form label col xs12'
            ],
            'wrapperOptions' => [
                'class' => 'form wrapper col xs12'
            ],
            'hintOptions' => [
                'class' => 'form hint col xs12'
            ],
            'errorOptions' => [
                'class' => 'form error col xs12'
            ],
            'template' => '{rowOpen}{wrapperOpen}{input}{hint}{wrapperClose}{error}{rowClose}'
        ]) ?>
        <?=$form->open([
            'id' => 'form-pages-form',
            'method' => 'POST',
            'class' => 'form'
        ])?>
        <div class='col xs6'>
            <?=$form->field( $model, 'url' )->input([
                'type' => 'text',
                'title' => $model->getAttributeDescription( 'url' ),
                'placeholder' => $model->getAttributeLabel( 'url' )
            ])?>
            <?=$form->field( $model, 'name' )->input([
                'type' => 'text',
                'title' => $model->getAttributeDescription( 'name' ),
                'placeholder' => $model->getAttributeLabel( 'name' )
            ])?>
        </div>

        <?=Html::button( 'send', [
            'class' => 'button submit'
        ])?>
        <?=$form->close()?>
    </div>
</div>
