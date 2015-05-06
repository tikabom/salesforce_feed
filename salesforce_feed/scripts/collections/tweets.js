/**
 * Defines a collection of Tweet models
 */

var app = app || {};

app.Tweets = Backbone.Collection.extend({
	url: 'php/tweets',
	model: app.Tweet,
	search: function(query) {
		/**
		 * filter predicate returns true 
		 * if model's tweet_content property
		 * contains passed arg query  
		 */
		return this.filter(function(tweet){
			return tweet.get('tweet_content').toLowerCase().indexOf(query) > 0;
		});
	}
});

app.Tweets = new app.Tweets();