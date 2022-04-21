<?php

return [

    // Configurações visíveis para o frontend
    'front' => [
        'app.name',
        'app.timezone',
        'app.locale',
        'jwt.ttl',
        'google.analytics.id',
        'app.style',
        'app.admin_layout',
    ],
    
    // Configurações disponíveis apenas para o backend
    'back' => [
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