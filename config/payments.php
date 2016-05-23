<?php

return [
    
    'Checkout' => [
        'processor' => 1,
        'key' => '',
        'auto_capture' => 'N',
        'auto_cap_time' => '0',
        'currency' => 'usd'
    ],
    
    'KNET' => [
        'processor' => 2,
        'alias' => '',
        'resource_path' => '',
        'language' => 'ENG',
        'action' => 1,
        'currency' => 414,
        'success_url' => 'https://www.yourdomain.com/response.php',
        'error_url' => 'https://www.yourdomain.com/error.php'
    ],

];