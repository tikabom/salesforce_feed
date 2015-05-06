# salesforce_feed
A simple twitter feed reader that shows the latest 10 tweets from @salesforce user timeline. The feed is updated every minute to reflect any new tweets on the timeline. The feed can also be filtered on a search query.

External APIs used:
  Front End: 
  JQuery
  Underscore
  Backbone
  
  Back End:
  twitter-api-php (courtesy James Mallison https://github.com/J7mbo)
  
IMPLEMENTATION DETAILS  
This application's Front End has been created using Backbone for an MVC client-side architecture.

It has been registered on the Twitters developers site to use Application based authentication (no user sign-in required, credentials created for the application to be authenticated on the Twitter REST API with Read and Write permissions). Application credentials, screen name and count (of tweets) have been hard-coded for simplicity. 

Supporting PHP wrapper twitter-api-php has been used to perform API requests in PHP. 

![Alt text](https://github.com/tikabom/salesforce_feed/blob/master/salesforce_feed/images/screenshot1.PNG "Init screen")

![Alt text](https://github.com/tikabom/salesforce_feed/blob/master/salesforce_feed/images/screenshot2.PNG "Filter example")
