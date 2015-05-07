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
				
				/**
				 * obtain app config args from
				 * configuration file: config.ini
				 */
				$ini_array = parse_ini_file("config.ini");
				
				$access_token = $ini_array["access_token"];				
				$access_token_secret = $ini_array["access_token_secret"];
				$consumer_key = $ini_array["consumer_key"];
				$consumer_secret = $ini_array["consumer_secret"];
				
				$screen_name = $ini_array["screen_name"];
				$count = $ini_array["count"];
				
				$feed = new TwitterFeed($access_token, $access_token_secret, 
						$consumer_key, $consumer_secret);
				
				echo $feed->get_feed($screen_name, $count);
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