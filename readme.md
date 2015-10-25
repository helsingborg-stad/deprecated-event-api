#External API for the Helsingborg Event Database

REST API built with PHP Slim Framework meant to be the only externally facing API to create/get/update events in the Event Database. The API in turn calls the WP API of the Event WP application as well as the internal Search API.

This code is not ready for production, so far it is a proof of concept. 

**Warning** Here be dragons

##Configuration
All configuration files are in teh /Config directory. There are one config file to handle API keys (_keys.json), one for Search API settings (_search_json) and one for Wordpress API settings (_wordpress.json).

Using prod_ config files if existing, otherwise test_ and finally dev_ if no other files exists

##Authentication
An API key in the parameter *key* is required for all requests. Keys and author_ids are configured in Config/prod_keys.json

##Get Event
     
     GET /v1/event?key=[key]&event_id=[event_id]&q=[query]

* *key* - API key identifiying the user of the API
* *event_id* - integer id of the event to return, do not need to be included when *q* is set
* *q* - query strings used to search for matching events, at the moment this is used to search only tags of events (not title, description etc). Note that this search is not yet hooked up to the search engine, it just returns hardcoded test data.

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

    POST /v1/event?key=[key]
    {    	
        "title" : "My new shiny event"
    }

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

##Data model
The event data model is heavily inspired by the [event object at schema.org](https://schema.org/event). The goal is that the API should be able to return valid schema.org data (which it does not do today). This would make it very easy to spread the event data to other systems that today accepts this format (like Google).

The systems own data model that is used when creating/updating events and when retreiving events is not exactly schema.org complient since there was a need to adapt, add some fields and remove some complexity in order to make the data model more workable. 

Some of the changes are:

* No super and sub events
* A schema.org event has one start and end time, this results in one theater play with 12 shows being represented by 12 event objects. Instead we have added the *shows* which is an array with one object that contains startDate, endDate, status and note. This means that startDate and endDate are removed from the event object.
* Email is moved from address to location
* Geo now contains a new field called projection (note: the search engine ONLY supports WGS84). We only support GeoCoordinates and not GeoShapes, ie only a specific geographical coordinate. If GeoShape is needed in the future GeoJSON should be used instead due to GeoShapes limitations.
* An event does not have a performer or organizer
* In AggregatedOffer the fields HighPrice and LowPrice are added
* Added fields created and modified to an event, both those fields are UTC dates

See an example of an event object at [piratepad](http://piratepad.net/RA1Xy8ZVfI).


##TODO
There are _a_lot_ of details to fix and features to add. Currently the code is at it's bare minimum. Some highlights:

* Hook this API up to the event search engine and not just hardcoded test files, see the Classes/Search.php file for this
* More search features, more parameters, geographical search etc
* More data fields when getting and creating an event, especially custom post type fields i WP
* When creating an event author_id needs to be sent to WP and WP needs to create the event with that author
* Updating an event
* Error handling and data validation needs to be added
* Better API key validation and administration. The keys should be linked to Wordpress users (via author_id) and thus probably created in Wordpress GUI.
* Be able to return valid schema.org formated data
* Better API documentation needs to be written. A start to a Swagger definition is available, but it is not complete and needs a lot of changes to be usable.

See comments in the code for more info.

