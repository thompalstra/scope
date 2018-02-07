<?php
use scope\widgets\Table;
use scope\Html;
?>
<div class='flow center'>
    <div class='module'>
            <?=Table::widget([
                'dataProvider' => $dataProvider,
                'rowUrl' => '/manage/pages/view?id={id}',
                'rowOptions' => [
                    'sc-on' => 'click',
                    'sc-event' => 'navigate',
                    'sc-url' => '/manage/pages/view?id={id}',
                    'sc-ignore-shift' => '1',
                    'sc-ignore-ctrl' => '1'
                ],
                'columns' => [
                    [
                        'cellOptions' => [
                            'class' => 'item select',
                            'style' => [
                                'width' => '25px'
                            ]
                        ],
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
</div>
