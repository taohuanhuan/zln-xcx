<?php
// config/console.php
return [
    // 在这里把你的命令名称映射到命令类
    'commands' => [
        'process:delayed_remind' => \application\command\ProcessDelayedRemind::class,
    ],
];
