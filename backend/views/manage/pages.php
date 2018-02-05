<?php
use scope\widgets\Table;
use scope\Html;
?>
<div class='flow center'>
<?=Table::widget([
    'dataProvider' => $dataProvider,
    'rowUrl' => '/manage/pages/view?id={id}',
    'columns' => [
        [
            'header' => '',
            'content' => function( $data ){
                return Html::input( [
                    'type' => 'checkbox',
                    'name' => "selected[$data->id]"
                ] );
            }
        ],
        [
            'header' => '#',
            'attribute' => 'id'
        ],
        [
            'header' => 'name',
            'attribute' => 'name'
        ],
        [
            'header' => 'url',
            'attribute' => 'url'
        ]
    ]
]);?>
</div>
