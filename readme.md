#External API for the Helsingborg Event Database

REST API built with PHP Slim Framework meant to be the only externally facing API to create/get/update events in the Event Database. The API in turn calls the WP API of the Event WP application as well as the internal Search API.

##Configuration
All configuration files are in teh /Config directory. There are one config file to handle API keys (*_keys.json), one for Search API settings (*_search_json) and one for Wordpress API settings (*_wordpress.json).

Using prod_ config files if existing, otherwise test_ and finally dev_ if no other files exists

##Authentication
An API key in the parameter *key* is required for all requests. Keys and author_ids are configured in Config/prod_keys.json

##Get Event
     
     GET /v1/event?key=[key]&event_id=[event_id]&q=[query]

* *key* - API key identifiying the user of the API
* *event_id* - integer id of the event to return, do not need to be included when *q* is set
* *q* - query strings used to search for matching events, at the moment this is used to search only tags of events (not title, description etc)

Returns JSON that is an event array with one event in.

Example response:

    {
        "events": [
            {
                "url": "http://event.dev/event/spraka-pa-serbokratiska",
                "name": "Språka på serbokratiska"
            }
        ]
    }

##Create Event

##TODO
There are _a_lot_ of details to fix and features to add. Currently the code is at it's bare minimum. Some highlights:

* Error handling
* Better API key validation and administration. The keys should be linked to Wordpress users (via author_id) and thus probably created in Wordpress GUI.
* More search features
* More data fields when getting and creating an event
* Updating an event

See comments in the code for more info.

**Warning** Here be monsters