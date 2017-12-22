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


	// Encrypt config
	'encryption' => [
		'key' => env('KEY_ENCRYPTION'),
	]				
];