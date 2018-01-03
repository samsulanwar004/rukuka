<?php

return [

	// config pos indonesia courier service 
	'is_pos_indonesia_prod' 	 => env('IS_POS_INDONESIA_PROD'),
	'sender_pos_code'			 => env('SENDER_POS_CODE'),
		
	'username_pos_indonesia_dev' => env('USERNAME_POS_INDONESIA_DEV'),
	'password_pos_indonesia_dev' => env('PASSWORD_POS_INDONESIA_DEV'),
	'wsdl_pos_indonesia_dev' 	 =>	env('WSDL_POS_INDONESIA_DEV'),

	'username_pos_indonesia_prod' => env('USERNAME_POS_INDONESIA_PROD'),
	'password_pos_indonesia_prod' => env('PASSWORD_POS_INDONESIA_PROD'),
	'wsdl_pos_indonesia_prod' 	  => env('WSDL_POS_INDONESIA_PROD'),

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