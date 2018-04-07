<?php

	ini_set('display_errors',0);
	ini_set('display_startup_erros',0);
	error_reporting(E_ALL);


	//$id		= '53358497@N04'; // Flickr ID at http://idgettr.com in case you want to use the id of a user you can use the api below
	//$url	= 'https://api.flickr.com/services/feeds/photos_public.gne?id='.$id.'&format=json&tags=chamonix,ski,snow';
	
	$url	= 'https://api.flickr.com/services/feeds/photos_public.gne?format=json&tags=chamonix,ski,snow';
	$ch		= curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		$response = curl_exec($ch);
	
	curl_close($ch);

	// Remove jsonp callback (jsonFlickrFeed) and escaped characters (except ")
	$json		= preg_replace('/\\\([^"])/', '$1', substr($response, 15, -1));
	$flickr		= json_decode($json);
	$display	= 20; //Numbers pictures to show