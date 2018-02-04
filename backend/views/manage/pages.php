<?php
use scope\widgets\Table;
?>

<?=Table::widget([
    'dataProvider' => $dataProvider,
    'rowUrl' => '/manage/pages/view?id={id}',
    'columns' => [
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
]);
