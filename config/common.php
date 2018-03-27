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

	// meta tag
	'do_follow' => env('DO_FOLLOW'),
	'default_desc' => env('DEFAULT_DESC'),
	'default_title' => env('DEFAULT_TITLE'),

	// config pos indonesia courier service
	'xendit_public_key' => env('XENDIT_PUBLIC_KEY'),
	'xendit_secret_key' => env('XENDIT_SECRET_KEY'),
	'xendit_secret_token' => env('XENDIT_VALIDATION_TOKEN'),

    // google analytics
    'google_analytics' => env('GOOGLE_ANALYTICS'),

    // default image
    'default' => [
        'image_1' => env('DEFAULT_IMAGE_1'),
        'image_2' => env('DEFAULT_IMAGE_2'),
        'image_3' => env('DEFAULT_IMAGE_3'),
        'image_4' => env('DEFAULT_IMAGE_4'),
        'image_5' => env('DEFAULT_IMAGE_5'),
        'image_6' => env('DEFAULT_IMAGE_6'),
        'image_7' => env('DEFAULT_IMAGE_7'),
    ],

    'logo' => env('LOGO'),

	// Encrypt config
	'encryption' => [
		'key' => env('KEY_ENCRYPTION'),
	],

	// signature for order to payment
	'order_key_signature' => env('ORDER_KEY_SIGNATURE'),

	'maintance_whitelist' => env('MAINTENANCE_WHITELIST'),

	'video_slide' => env('VIDEO_SLIDE'),

	'video_slide2' => env('VIDEO_SLIDE2'),

	'queue_active' => env('QUEUE_ACTIVE'),

	'queue_list' => [
		'user_mail' => env('QUEUE_MAIL_NAME')
	],

	'image' => [
		'small' => [
            'width' => env('IMAGE_SMALL_WIDTH'),
            'height' => env('IMAGE_SMALL_HEIGHT'),
        ],
        'medium' => [
            'width' => env('IMAGE_MEDIUM_WIDTH'),
            'height' => env('IMAGE_MEDIUM_HEIGHT'),
        ],
	]
];
