#External API for the Helsingborg Event Database

##Authentication
An API key in the parameter *key* is required for all requests. Keys and author_ids are configured in Config/prod_keys.json

##Get Event
     
     GET /v1/event?key=[key]&event_id=[event_id]

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