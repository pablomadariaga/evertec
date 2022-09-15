<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Login credential
    |--------------------------------------------------------------------------
    | This option allows you to specify the login credential for integration with
    | Placetopay. You must configure the credential in the environment file
    |
    */

    'login' => env('PLACETOPAY_LOGIN',null),

    /*
    |--------------------------------------------------------------------------
    | Secret key credential
    |--------------------------------------------------------------------------
    | This option allows you to specify the secret key credential for integration
    | with Placetopay, it is used to generate the transactional key, you must
    | configure the credential in the environment file
    |
    */

    'secret' => env('PLACETOPAY_SECRET_KEY',null),
];
