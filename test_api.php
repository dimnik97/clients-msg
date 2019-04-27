<?php

$permissions = [
	'market'
];

$request_params = [
	'client_id' => '6963178',
	'redirect_uri' => 'https://oauth.vk.com/blank.html',
	'response_type' => 'token',
	'display' => 'page',
	'scope' => implode(',', $permissions),
	'v' => '5.95' 
];

$url = 'https://oauth.vk.com/authorize?' . http_build_query($request_params);

echo $url;

// 45e3df0083acd214c19217332b87eec8833b872f5b2f5c20dee81aadb7a049972ea4aed485802cf9d3342