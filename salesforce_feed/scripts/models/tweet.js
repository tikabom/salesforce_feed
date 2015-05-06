/**
 * Defines a Tweet Model
 */

var app = app || {};


app.Tweet = Backbone.Model.extend({
	defaults: {
		user_name: '',
		user_screen_name: '',
		user_profile_img_url: '',
		tweet_content: '',
		retweet_count: 0
	}
});