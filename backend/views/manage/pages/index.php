<?php
use common\models\User;
$query = \Scope::query()->from( User::className() )->where([
    'and',
    [
        'and',
        ['user.is_deleted' => 0],
        ['user.is_enabled' => 1]
    ],
    [
        'and',
        ['<>', 'user.password_hash', null]
    ]
])->orWhere([
    'and',
    ['test' => 'yo'],
    ['best' => 'yo']
]);
?>
<code style='white-space: pre;'>$query = \Scope::query()->from( User::className() )->where([
    'and',
    [
        'and',
        ['user.is_deleted' => 0],
        ['user.is_enabled' => 1]
    ],
    [
        'and',
        ['<>', 'user.password_hash', null]
    ]
])->orWhere([
    'and',
    ['test' => 'yo'],
    ['best' => 'yo']
]);

print_r( $query->createCommand() );
</code>

<?=$query->createCommand()?>
