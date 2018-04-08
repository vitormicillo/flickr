<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_erros', 1);
	error_reporting(E_ALL);

	/*
	* in case you want to use the id of a user you can use the api below
	*/
	//$id		= '53358497@N04'; // Flickr ID at http://idgettr.com 
	//$url	= 'https://api.flickr.com/services/feeds/photos_public.gne?id='.$id.'&format=json&tags=chamonix,ski,snow';
	
	$url	= 'https://api.flickr.com/services/feeds/photos_public.gne?format=json&tags=chamonix,ski,snow';
    $ch		= curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
	curl_close($ch);

	// Remove jsonp callback (jsonFlickrFeed) and escaped characters (except ")
	$json		= preg_replace('/\\\([^"])/', '$1', substr($response, 15, -1));
	$flickr		= json_decode($json);
    $display	= 16; //Numbers pictures to show
    $pagina = $_POST['pagina'];
    $items = [];
    $a = 1;
    $j = -1;

    for ($i = $pagina * $display; $i < count($flickr->items) && $i < ($pagina + 1) * $display; $i++)
    {
        $photo = $flickr->items[$i];
        if($photo->media->m != ''):
            if($a == 1)
            {
                $j++;
                $items[$j] = array();
            }

            $items[$j][] = $photo;

            if($a == 4)
            {
                $a = 0;
            }
            $a++;
        endif;
    }

    echo json_encode($items);