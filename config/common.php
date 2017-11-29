<?php

return [

	// config pos indonesia courier service 
	'username_pos_indonesia' => env('USERNAME_POS_INDONESIA'),
	'password_pos_indonesia' => env('PASSWORD_POS_INDONESIA'),
	'wsdl_pos_indonesia' 	 =>	env('WSDL_POS_INDONESIA'),


	// Encrypt config
	'encryption' => [
		'key' => env('KEY_ENCRYPTION'),
	]				
];