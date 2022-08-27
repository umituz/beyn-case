<?php

return [
    'driver' => 'slack',
    'endpoint' => env('SLACK_HOST'),
    'channels' => [
        'sync_automobiles' => 'sync_automobiles',
    ],
    'icon' => ':crossed_swords:',
    'username' => 'Slack Messenger',
];
