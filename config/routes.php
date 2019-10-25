<?php

return [
    // TaskController
    '' => [
        'controller' => 'task',
        'action' => 'index',
    ],
    'task/index/{page:\d+}' => [
        'controller' => 'task',
        'action' => 'index',
    ],
    'task/add' => [
        'controller' => 'task',
        'action' => 'add',
    ],

    // AdminController
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/update-status/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'update',
    ],
    'admin/tasks/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'tasks',
    ],
    'admin/tasks' => [
        'controller' => 'admin',
        'action' => 'tasks',
    ],
];
