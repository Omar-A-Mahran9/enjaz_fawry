<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	//'margin_header' => 30,     // 30mm not pixel
	'margin_top' => 30,     // 30mm not pixel

	'author'                => 'Enjaz-Fawry',
	'subject'               => 'Invoice',
	'keywords'              => 'report',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'default_font'          => 'arial',
	//	'default_font'         => 'XBRiyaz',

	'tempDir'               => base_path('../temp/'),
	'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
	'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
];
