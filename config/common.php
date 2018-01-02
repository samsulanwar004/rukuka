<?php

return [

	// config pos indonesia courier service 
	'username_pos_indonesia' => env('USERNAME_POS_INDONESIA'),
	'password_pos_indonesia' => env('PASSWORD_POS_INDONESIA'),
	'wsdl_pos_indonesia' 	 =>	env('WSDL_POS_INDONESIA'),

	// config pos indonesia courier service 
	'xendit_public_key' => env('XENDIT_PUBLIC_KEY'),
	'xendit_secret_key' => env('XENDIT_SECRET_KEY'),
	'xendit_secret_token' => env('XENDIT_VALIDATION_TOKEN'),

    // default image
    'default' => [
        'image_1' => env('DEFAULT_IMAGE_1'),
        'image_2' => env('DEFAULT_IMAGE_2'),
        'image_3' => env('DEFAULT_IMAGE_3'),
        'image_4' => env('DEFAULT_IMAGE_4'),
        'image_5' => env('DEFAULT_IMAGE_5'),
        'image_6' => env('DEFAULT_IMAGE_6'),
    ],

    'logo' => env('LOGO'),

	// Encrypt config
	'encryption' => [
		'key' => env('KEY_ENCRYPTION'),
	]				
];