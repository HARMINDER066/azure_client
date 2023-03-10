<?php
if ( env('APP_HOST') == 'local') {
    return [
        'database' => [
            'DB_HOST' => 'localhost',
            'DB_PORT' => '3306',
            'DB_DATABASE' => 'chatsilo',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '',
        ],
        'mail' => [
            'MAIL_HOST' => 'smtp.gmail.com',
            'MAIL_PORT' => '465',
            'MAIL_ENCRYPTION' => 'TLS',
            'MAIL_USERNAME' => 'sobindrapanwar@gmail.com',
            'MAIL_PASSWORD' => 'rwlhswmuojyxffxq',
        ],
        'google' => [
            // 'RECAPTCHAV3_ORIGIN' => 'https://www.google.com/recaptcha',
            // 'RECAPTCHAV3_SITEKEY' => '6LdobAIiAAAAACSnBEyyp3AMEBD9MUf9zO5GpOGP',
            // 'RECAPTCHAV3_SECRET' => '6LdobAIiAAAAAO_8C0dP0yRPJlZbqf9ddxmsYPU8',
        ],
    ];
    

} else {
    return [
        'database' => [
            'DB_HOST' => 'localhost',
            'DB_PORT' => '3306',
            'DB_DATABASE' => 'u581383413_dropinlaravel',
            'DB_USERNAME' => 'u581383413_dropinuser',
            'DB_PASSWORD'=>'jg0qRZ@V;q9U'
        ],
        'mail' => [
            'MAIL_HOST' => 'smtp.gmail.com',
            'MAIL_PORT' => '465',
            'MAIL_ENCRYPTION' => 'TLS',
            'MAIL_USERNAME' => 'sobindrapanwar@gmail.com',
            'MAIL_PASSWORD' => 'rwlhswmuojyxffxq',
        ],
        // 'google' => [
        //     'RECAPTCHAV3_ORIGIN' => 'https://www.google.com/recaptcha',
        //     'RECAPTCHAV3_SITEKEY' => '6LdobAIiAAAAACSnBEyyp3AMEBD9MUf9zO5GpOGP',
        //     'RECAPTCHAV3_SECRET' => '6LdobAIiAAAAAO_8C0dP0yRPJlZbqf9ddxmsYPU8',
        // ],
    ];
}
