<?php

return [
    'role_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'thread' => 'c,r,u,d',
            'reply' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'admin' => [
            'thread' => 'c,r,u,d',
            'reply' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user' => [
            'thread' => 'c,r,u',
            'reply' => 'c,r,u',
            'profile' => 'r,u'
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
