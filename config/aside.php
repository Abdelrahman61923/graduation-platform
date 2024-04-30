<?php


return [
    "student" => [
        [
            'icon' => 'home',
            'route' => 'students.dashboard',
            'title' => 'Dashboard',
            'active' => 'students.dashboard'
        ],
        [
            'icon' => 'users',
            'route' => 'students.my-team',
            'title' => 'My Team',
            'active' => 'students.my-team'
        ],
        [
            'icon' => 'users',
            'route' => 'students.upload-book',
            'title' => 'upload-book',
            'active' => 'students.upload-book'
        ],
    ],
    "supervisor" => [
        [
            'icon' => 'home',
            'route' => 'supervisors.dashboard',
            'title' => 'Dashboard',
            'active' => 'supervisors.dashboard'
        ],
        [
            'icon' => 'users',
            'route' => 'supervisors.my-teams',
            'title' => 'My Teams',
            'active' => 'supervisors.my-teams.*'
        ],
    ],
    "admin" => [
        [
            'icon' => 'home',
            'route' => 'admins.dashboard',
            'title' => 'Dashboard',
            'active' => 'admins.dashboard'
        ],
        [
            'icon' => 'users',
            'route' => 'users.index',
            'title' => 'Users',
            'active' => 'users.*'
        ],
        [
            'icon' => 'check-square',
            'route' => 'departments.index',
            'title' => 'Departments',
            'active' => 'departments.*'
        ],
        [
            'icon' => 'shopping-bag',
            'route' => 'tags.index',
            'title' => 'Tags',
            'active' => 'tags.*'
        ],
        [
            'icon' => 'box',
            'route' => 'admins.teams',
            'title' => 'Teams',
            'active' => 'admins.teams'
        ],
        [
            'icon' => 'settings',
            'route' => 'admins.settings',
            'title' => 'Settings',
            'active' => 'admins.settings'
        ],
        [
            'icon' => 'settings',
            'route' => 'admins.instructions',
            'title' => 'Instructions',
            'active' => 'admins.instructions'
        ],
    ],
];
