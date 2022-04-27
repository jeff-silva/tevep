<?php

return [

    // Configurações visíveis para o frontend
    'front' => [
        'app.name',
        'app.timezone',
        'app.locale',
        'google.analytics.id',
        'app.admin_layout',
        'app.icon',
        'app.logo',
    ],
    
    // Configurações disponíveis apenas para o backend
    'back' => [
        'jwt.ttl',
        'mail.default',
        'mail.mailers.smtp.host',
        'mail.mailers.smtp.port',
        'mail.mailers.smtp.username',
        'mail.mailers.smtp.password',
        'mail.from.address',
        'mail.from.name',
        'app_models_files.storage_type',
        'app_models_files.max_upload_size',
    ],
];