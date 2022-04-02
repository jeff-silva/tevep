<?php

return [
    // database = guarda o arquivo no banco formatado em base64 ou texto puro dependendo do tipo de arquivo
    // file = salva o arquivo na pasta /public/uploads
    'storage_type' => 'database',
    
    'max_upload_size' => 1024*1024*8,
];