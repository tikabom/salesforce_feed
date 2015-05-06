<?php
/**
 * Include OAuth 1.1 Twitter REST API support wrapper in PHP
 */
require_once 'TwitterAPIExchange.php';

/**
 * Twitter feed 
 * @author aiyer
 * Application based Authentication for Twitter REST API
 */
class TwitterFeed {
	/**
	 * Access Token for the registered app
	 * @var access_token 
	 */
	private $access_token;
	/**
	 * Access Token Secret for the registered app
	 * @var access_token_secret
	 */
	private $access_token_secret;
	/**
	 * Consumer Key for the registered app
	 * @var consumer_key
	 */
	private $consumer_key;
	/**
	 * Consumer Secret for the registered app
	 * @var consumer_secret
	 */
	private $consumer_secret;
	
	function __construct(){
		$this->access_token = "474453436-qZ7MTuKMCMoI8Vp0mzZx7RH5iYJbcgfNFuCtG3GV";
		$this->access_token_secret = "eOs4ExucxAq9H1PQCJwcGkq0gb7QMJu7WZWPwQazHriqu";
		$this->consumer_key = "YkwMxref8IbIh4Xf4VDtgN580";
		$this->consumer_secret = "xaeGSpyRg9x41lXJGVzBNIhmDjx0wSxGfow0K6FRz6CFiMw9ez";
	}
	
	/**
	 * Returns the 10 more recent tweets for salesforce screen name
	 * @return json
	 */
	function get_feed() {
		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$params = '?screen_name=salesforce&count=10';
		$method = 'GET';
		
		$settings = array(
				"oauth_access_token" => $this->access_token, 
				"oauth_access_token_secret" => $this->access_token_secret, 
				"consumer_key" => $this->consumer_key, 
				"consumer_secret" => $this->consumer_secret);
		
		$twitter = new TwitterAPIExchange($settings);
		$json = $twitter->setGetfield($params)->buildOauth($url, $method)->performRequest();
		$tweets = json_decode($json, true);
		
		$feed = array();
		
		foreach($tweets as $tweet) {
			$text = $tweet["text"];
			$urls = $tweet["entities"]["urls"];
			
			if(isset($urls)) {
				foreach($urls as $url) {
					$href = $url["expanded_url"];
					$urltext = $url["url"];
					$anchor = "<a target='_blank' href='" . $href . "'>" . $urltext . "</a>";
					$text = substr_replace($text, $anchor, strpos($text, $urltext), strlen($urltext));				
				}
			}
			
			if(isset($tweet["entities"]["media"])) {
				$media = $tweet["entities"]["media"];
				foreach($media as $url) {
					$href = $url["media_url"];
					$urltext = $url["url"];
					$anchor = "<a target='_blank' href='" . $href . "'>" . $urltext . "</a>";
					$text = substr_replace($text, $anchor, strpos($text, $urltext), strlen($urltext));				
				}
			}
			
			array_push($feed, array(
				"user_name" => $tweet["user"]["name"],
				"user_screen_name" => $tweet["user"]["screen_name"],
				"user_profile_img_url" => $tweet["user"]["profile_image_url"],
				"tweet_content" => $text,
				"retweet_count" =>$tweet["retweet_count"]				
			));
		}
		
		return json_encode($feed);
	}
}

?>