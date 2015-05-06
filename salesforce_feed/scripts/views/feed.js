/**
 * Defines the view that displays the Tweet collection 
 */

var app = app || {};

$(function() {
	app.Feed = Backbone.View.extend({
		el: '.envelope',
		template: _.template($('#tweet-template').html()),
		initialize: function() {
			/** create a new collection of tweets **/
			this.collection = app.Tweets;
			/** bind event filterFeed **/
			this.on('filterFeed', this.filterFeed);
			var self = this;
			this.collection.fetch({
				success: function() {
					self.render();
				}
			});
			/** refresh collection state every 60 seconds **/
			this.refresh = setInterval(function() {
				self.resetCollection();
			}, 60000);
		},
		render: function() {
			$('#tweets', this.el).html('');
			var self = this;
			_(this.collection.models).each(function(tweet) {
				$('#tweets', self.el).append(self.template(tweet.toJSON()));
			});
		},
		/**
		 * event handler for tweet search
		 */
		filterFeed: function(query) {
			if(query.trim() != '') {
				var filteredCollection = this.collection.search(query.toLowerCase());
				this.refreshView(filteredCollection);
			}
			this.query = query;
		},
		/**
		 * update view when associated tweet collection is updated
		 */
		refreshView: function(filteredCollection) {
			$('#tweets', this.el).html('');
			var self = this;
			_(filteredCollection).each(function(tweet) {
				$('#tweets', self.el).append(self.template(tweet.toJSON()));
			});
		},
		/**
		 * callback for the collection refresh per minute event 
		 */
		resetCollection: function() {
			$('#tweets', this.el).css('opacity', 0.2);
			$('.processing', this.el).show();
			var self = this;
			this.collection.fetch({
				success: function() {
					if(self.query != null)
						self.filterFeed(self.query);
					else
						self.render();
					$('#tweets', self.el).css('opacity', 1);
					$('.processing', self.el).hide();
				}
			});
		},
		/**
		 * garbage collection when view is closed
		 */
		removeView: function() {
			$('#tweets', this.el).removeData().unbind();
			clearInterval(this.refresh);
			$('#tweets', this.el).html('');
		}
	});

	app.Feed = new app.Feed();
});


