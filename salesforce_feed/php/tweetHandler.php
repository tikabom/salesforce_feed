<?php

require_once 'TwitterFeed.php';

$httpMethod = $_SERVER["REQUEST_METHOD"];
$request = $_SERVER["REQUEST_URI"];

/**
 * accepts only http request: GET php/tweets
 * returns salesforce feed if http request is valid
 * raises http error 405 Bad Request if http request is invalid
 */
switch($httpMethod) {
	case 'GET': 
		$params = explode("/", $request);
		$count = count($params);
		if(count($params) > 0) {
			if($params[$count - 1] == "tweets") {
				$feed = new TwitterFeed();
				echo $feed->get_feed();
			}
			else {
				http_response_code(405);
			}
		}
		else {
			http_response_code(405);
		}
		break;
	default: 
		http_response_code(405);
}

?>