<?php return [
  'auth-login' => [
    'route' => 'auth/login',
    'call' => '\\App\\Http\\Controllers\\AuthController@login',
    'method' => 'post',
  ],
  'auth-logout' => [
    'route' => 'auth/logout',
    'call' => '\\App\\Http\\Controllers\\AuthController@logout',
    'method' => 'post',
  ],
  'auth-refresh' => [
    'route' => 'auth/refresh',
    'call' => '\\App\\Http\\Controllers\\AuthController@refresh',
    'method' => 'post',
  ],
  'auth-me' => [
    'route' => 'auth/me',
    'call' => '\\App\\Http\\Controllers\\AuthController@me',
    'method' => 'post',
  ],
  'auth-register' => [
    'route' => 'auth/register',
    'call' => '\\App\\Http\\Controllers\\AuthController@register',
    'method' => 'post',
  ],
  'auth-password-reset-start' => [
    'route' => 'auth/password-reset-start',
    'call' => '\\App\\Http\\Controllers\\AuthController@passwordResetChange',
    'method' => 'post',
  ],
  'app-test' => [
    'route' => 'app/test',
    'call' => '\\App\\Http\\Controllers\\AppController@test',
    'method' => 'get',
  ],
  'app-endpoints' => [
    'route' => 'app/endpoints',
    'call' => '\\App\\Http\\Controllers\\AppController@endpoints',
    'method' => 'get',
  ],
  'app-search' => [
    'route' => 'app/search',
    'call' => '\\App\\Http\\Controllers\\AppController@search',
    'method' => 'get',
  ],
  'app-mail-test' => [
    'route' => 'app/mail-test',
    'call' => '\\App\\Http\\Controllers\\AppController@mail-test',
    'method' => 'get',
  ],
  'app-settings-get-all' => [
    'route' => 'settings',
    'call' => '\\App\\Http\\Controllers\\SettingsController@getAll',
    'method' => 'get',
  ],
  'app-settings-save-all' => [
    'route' => 'settings',
    'call' => '\\App\\Http\\Controllers\\SettingsController@saveAll',
    'method' => 'post',
  ],
  'files-view' => [
    'route' => 'files/view/{slug}.{ext}',
    'call' => '\\App\\Http\\Controllers\\FilesController@view',
    'method' => 'get',
  ],
  'files-search' => [
    'route' => 'files/search',
    'call' => '\\App\\Http\\Controllers\\FilesController@search',
    'method' => 'get',
  ],
  'files-find' => [
    'method' => 'get',
    'route' => 'files/find/{id}',
    'call' => '\\App\\Http\\Controllers\\FilesController@find',
  ],
  'files-save' => [
    'method' => 'post',
    'route' => 'files/save',
    'call' => '\\App\\Http\\Controllers\\FilesController@save',
  ],
  'files-valid' => [
    'method' => 'post',
    'route' => 'files/valid',
    'call' => '\\App\\Http\\Controllers\\FilesController@valid',
  ],
  'files-delete' => [
    'method' => 'post',
    'route' => 'files/delete',
    'call' => '\\App\\Http\\Controllers\\FilesController@delete',
  ],
  'files-restore' => [
    'method' => 'post',
    'route' => 'files/restore',
    'call' => '\\App\\Http\\Controllers\\FilesController@restore',
  ],
  'files-clone' => [
    'method' => 'post',
    'route' => 'files/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\FilesController@clone',
  ],
  'files-import' => [
    'method' => 'post',
    'route' => 'files/import',
    'call' => '\\App\\Http\\Controllers\\FilesController@import',
  ],
  'files-export' => [
    'method' => 'get',
    'route' => 'files/export',
    'call' => '\\App\\Http\\Controllers\\FilesController@export',
  ],
  'life-events-search' => [
    'route' => 'life-events/search',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@search',
    'method' => 'get',
  ],
  'life-events-find' => [
    'method' => 'get',
    'route' => 'life-events/find/{id}',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@find',
  ],
  'life-events-save' => [
    'method' => 'post',
    'route' => 'life-events/save',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@save',
  ],
  'life-events-valid' => [
    'method' => 'post',
    'route' => 'life-events/valid',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@valid',
  ],
  'life-events-delete' => [
    'method' => 'post',
    'route' => 'life-events/delete',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@delete',
  ],
  'life-events-restore' => [
    'method' => 'post',
    'route' => 'life-events/restore',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@restore',
  ],
  'life-events-clone' => [
    'method' => 'post',
    'route' => 'life-events/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@clone',
  ],
  'life-events-import' => [
    'method' => 'post',
    'route' => 'life-events/import',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@import',
  ],
  'life-events-export' => [
    'method' => 'get',
    'route' => 'life-events/export',
    'call' => '\\App\\Http\\Controllers\\LifeEventsController@export',
  ],
  'life-persons-search' => [
    'route' => 'life-persons/search',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@search',
    'method' => 'get',
  ],
  'life-persons-find' => [
    'method' => 'get',
    'route' => 'life-persons/find/{id}',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@find',
  ],
  'life-persons-save' => [
    'method' => 'post',
    'route' => 'life-persons/save',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@save',
  ],
  'life-persons-valid' => [
    'method' => 'post',
    'route' => 'life-persons/valid',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@valid',
  ],
  'life-persons-delete' => [
    'method' => 'post',
    'route' => 'life-persons/delete',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@delete',
  ],
  'life-persons-restore' => [
    'method' => 'post',
    'route' => 'life-persons/restore',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@restore',
  ],
  'life-persons-clone' => [
    'method' => 'post',
    'route' => 'life-persons/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@clone',
  ],
  'life-persons-import' => [
    'method' => 'post',
    'route' => 'life-persons/import',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@import',
  ],
  'life-persons-export' => [
    'method' => 'get',
    'route' => 'life-persons/export',
    'call' => '\\App\\Http\\Controllers\\LifePersonsController@export',
  ],
  'life-persons-interactions-search' => [
    'route' => 'life-persons-interactions/search',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@search',
    'method' => 'get',
  ],
  'life-persons-interactions-find' => [
    'method' => 'get',
    'route' => 'life-persons-interactions/find/{id}',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@find',
  ],
  'life-persons-interactions-save' => [
    'method' => 'post',
    'route' => 'life-persons-interactions/save',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@save',
  ],
  'life-persons-interactions-valid' => [
    'method' => 'post',
    'route' => 'life-persons-interactions/valid',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@valid',
  ],
  'life-persons-interactions-delete' => [
    'method' => 'post',
    'route' => 'life-persons-interactions/delete',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@delete',
  ],
  'life-persons-interactions-restore' => [
    'method' => 'post',
    'route' => 'life-persons-interactions/restore',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@restore',
  ],
  'life-persons-interactions-clone' => [
    'method' => 'post',
    'route' => 'life-persons-interactions/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@clone',
  ],
  'life-persons-interactions-import' => [
    'method' => 'post',
    'route' => 'life-persons-interactions/import',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@import',
  ],
  'life-persons-interactions-export' => [
    'method' => 'get',
    'route' => 'life-persons-interactions/export',
    'call' => '\\App\\Http\\Controllers\\LifePersonsInteractionsController@export',
  ],
  'life-worlds-search' => [
    'route' => 'life-worlds/search',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@search',
    'method' => 'get',
  ],
  'life-worlds-find' => [
    'method' => 'get',
    'route' => 'life-worlds/find/{id}',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@find',
  ],
  'life-worlds-save' => [
    'method' => 'post',
    'route' => 'life-worlds/save',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@save',
  ],
  'life-worlds-valid' => [
    'method' => 'post',
    'route' => 'life-worlds/valid',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@valid',
  ],
  'life-worlds-delete' => [
    'method' => 'post',
    'route' => 'life-worlds/delete',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@delete',
  ],
  'life-worlds-restore' => [
    'method' => 'post',
    'route' => 'life-worlds/restore',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@restore',
  ],
  'life-worlds-clone' => [
    'method' => 'post',
    'route' => 'life-worlds/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@clone',
  ],
  'life-worlds-import' => [
    'method' => 'post',
    'route' => 'life-worlds/import',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@import',
  ],
  'life-worlds-export' => [
    'method' => 'get',
    'route' => 'life-worlds/export',
    'call' => '\\App\\Http\\Controllers\\LifeWorldsController@export',
  ],
  'pages-search' => [
    'route' => 'pages/search',
    'call' => '\\App\\Http\\Controllers\\PagesController@search',
    'method' => 'get',
  ],
  'pages-find' => [
    'method' => 'get',
    'route' => 'pages/find/{id}',
    'call' => '\\App\\Http\\Controllers\\PagesController@find',
  ],
  'pages-save' => [
    'method' => 'post',
    'route' => 'pages/save',
    'call' => '\\App\\Http\\Controllers\\PagesController@save',
  ],
  'pages-valid' => [
    'method' => 'post',
    'route' => 'pages/valid',
    'call' => '\\App\\Http\\Controllers\\PagesController@valid',
  ],
  'pages-delete' => [
    'method' => 'post',
    'route' => 'pages/delete',
    'call' => '\\App\\Http\\Controllers\\PagesController@delete',
  ],
  'pages-restore' => [
    'method' => 'post',
    'route' => 'pages/restore',
    'call' => '\\App\\Http\\Controllers\\PagesController@restore',
  ],
  'pages-clone' => [
    'method' => 'post',
    'route' => 'pages/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\PagesController@clone',
  ],
  'pages-import' => [
    'method' => 'post',
    'route' => 'pages/import',
    'call' => '\\App\\Http\\Controllers\\PagesController@import',
  ],
  'pages-export' => [
    'method' => 'get',
    'route' => 'pages/export',
    'call' => '\\App\\Http\\Controllers\\PagesController@export',
  ],
  'settings-search' => [
    'route' => 'settings/search',
    'call' => '\\App\\Http\\Controllers\\SettingsController@search',
    'method' => 'get',
  ],
  'settings-find' => [
    'method' => 'get',
    'route' => 'settings/find/{id}',
    'call' => '\\App\\Http\\Controllers\\SettingsController@find',
  ],
  'settings-save' => [
    'method' => 'post',
    'route' => 'settings/save',
    'call' => '\\App\\Http\\Controllers\\SettingsController@save',
  ],
  'settings-valid' => [
    'method' => 'post',
    'route' => 'settings/valid',
    'call' => '\\App\\Http\\Controllers\\SettingsController@valid',
  ],
  'settings-delete' => [
    'method' => 'post',
    'route' => 'settings/delete',
    'call' => '\\App\\Http\\Controllers\\SettingsController@delete',
  ],
  'settings-restore' => [
    'method' => 'post',
    'route' => 'settings/restore',
    'call' => '\\App\\Http\\Controllers\\SettingsController@restore',
  ],
  'settings-clone' => [
    'method' => 'post',
    'route' => 'settings/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\SettingsController@clone',
  ],
  'settings-import' => [
    'method' => 'post',
    'route' => 'settings/import',
    'call' => '\\App\\Http\\Controllers\\SettingsController@import',
  ],
  'settings-export' => [
    'method' => 'get',
    'route' => 'settings/export',
    'call' => '\\App\\Http\\Controllers\\SettingsController@export',
  ],
  'user-search' => [
    'route' => 'user/search',
    'call' => '\\App\\Http\\Controllers\\UserController@search',
    'method' => 'get',
  ],
  'user-find' => [
    'method' => 'get',
    'route' => 'user/find/{id}',
    'call' => '\\App\\Http\\Controllers\\UserController@find',
  ],
  'user-save' => [
    'method' => 'post',
    'route' => 'user/save',
    'call' => '\\App\\Http\\Controllers\\UserController@save',
  ],
  'user-valid' => [
    'method' => 'post',
    'route' => 'user/valid',
    'call' => '\\App\\Http\\Controllers\\UserController@valid',
  ],
  'user-delete' => [
    'method' => 'post',
    'route' => 'user/delete',
    'call' => '\\App\\Http\\Controllers\\UserController@delete',
  ],
  'user-restore' => [
    'method' => 'post',
    'route' => 'user/restore',
    'call' => '\\App\\Http\\Controllers\\UserController@restore',
  ],
  'user-clone' => [
    'method' => 'post',
    'route' => 'user/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\UserController@clone',
  ],
  'user-import' => [
    'method' => 'post',
    'route' => 'user/import',
    'call' => '\\App\\Http\\Controllers\\UserController@import',
  ],
  'user-export' => [
    'method' => 'get',
    'route' => 'user/export',
    'call' => '\\App\\Http\\Controllers\\UserController@export',
  ],
  'users-groups-search' => [
    'route' => 'users-groups/search',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@search',
    'method' => 'get',
  ],
  'users-groups-find' => [
    'method' => 'get',
    'route' => 'users-groups/find/{id}',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@find',
  ],
  'users-groups-save' => [
    'method' => 'post',
    'route' => 'users-groups/save',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@save',
  ],
  'users-groups-valid' => [
    'method' => 'post',
    'route' => 'users-groups/valid',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@valid',
  ],
  'users-groups-delete' => [
    'method' => 'post',
    'route' => 'users-groups/delete',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@delete',
  ],
  'users-groups-restore' => [
    'method' => 'post',
    'route' => 'users-groups/restore',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@restore',
  ],
  'users-groups-clone' => [
    'method' => 'post',
    'route' => 'users-groups/clone/{id}',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@clone',
  ],
  'users-groups-import' => [
    'method' => 'post',
    'route' => 'users-groups/import',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@import',
  ],
  'users-groups-export' => [
    'method' => 'get',
    'route' => 'users-groups/export',
    'call' => '\\App\\Http\\Controllers\\UsersGroupsController@export',
  ],
];