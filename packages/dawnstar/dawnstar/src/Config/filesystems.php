<?php
return [
    'default' => 'public',
    'disks' => [
        'public' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'url' => '/uploads',
            'visibility' => 'public',
        ]
    ]
];
