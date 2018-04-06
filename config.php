<?php

	$id		= '53358497@N04'; // Flickr ID at http://idgettr.com
	$url	= 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$id.'&format=json';
	$ch		= curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		$response = curl_exec($ch);
	
	curl_close($ch);

	// Remove jsonp callback (jsonFlickrFeed) and escaped characters (except ")
	$json		= preg_replace('/\\\([^"])/', '$1', substr($response, 15, -1));
	$flickr		= json_decode($json);
	$display	= 25; //Numbers pictures to show