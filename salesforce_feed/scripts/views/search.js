/**
 * Defines the search view and its keyup event binding
 */

var app = app || {};

$(function() {
	/**
	 * View associated with the search input
	 */
	app.Search = Backbone.View.extend({
		el: '#search',
		/**
		 * bind the keyup event on search input
		 * with callback method searchFeed
		 */
		events: {
			'keyup' : 'searchFeed'
		},
		initialize: function() {
			
		},
		searchFeed: function() {
			var self = this;
			/**
			 * delegates the search to the Feed view
			 * to filter its collection
			 */
			app.Feed.trigger('filterFeed', self.$el.val());
		}
	});
	
	app.Search = new app.Search();
});