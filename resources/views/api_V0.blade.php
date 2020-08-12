<!DOCTYPE HTML><html><head><title>Home Advisor API documentation</title><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="generator" content="https://github.com/raml2html/raml2html 7.4.0"><link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css"><script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script><script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script><script type="text/javascript">
      $(document).ready(function() {
  $('.page-header pre code, .top-resource-description pre code, .modal-body pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });

  $('[data-toggle]').click(function() {
    var selector = $(this).data('target') + ' pre code';
    $(selector).each(function(i, block) {
      hljs.highlightBlock(block);
    });
  });

  // open modal on hashes like #_action_get
  $(window).bind('hashchange', function(e) {
    var anchor_id = document.location.hash.substr(1); //strip #
    var element = $('#' + anchor_id);

    // do we have such element + is it a modal?  --> show it
    if (element.length && element.hasClass('modal')) {
      element.modal('show');
    }
  });

  // execute hashchange on first page load
  $(window).trigger('hashchange');

  // remove url fragment on modal hide
  $('.modal').on('hidden.bs.modal', function() {
    try {
      if (history && history.replaceState) {
          history.replaceState({}, '', '#');
      }
    } catch(e) {}
  });
});
    </script><style>
      .hljs {
  background: transparent;
}
.parent {
  color: #999;
}
.list-group-item > .badge {
  float: none;
  margin-right: 6px;
}
.panel-title > .methods {
  float: right;
}
.badge {
  border-radius: 0;
  text-transform: uppercase;
  width: 70px;
  font-weight: normal;
  color: #f3f3f6;
  line-height: normal;
}
.badge_get {
  background-color: #63a8e2;
}
.badge_post {
  background-color: #6cbd7d;
}
.badge_put {
  background-color: #22bac4;
}
.badge_delete {
  background-color: #d26460;
}
.badge_patch {
  background-color: #ccc444;
}
.list-group,
.panel-group {
  margin-bottom: 0;
}
.panel-group .panel+.panel-white {
  margin-top: 0;
}
.panel-group .panel-white {
  border-bottom: 1px solid #F5F5F5;
  border-radius: 0;
}
.panel-white:last-child {
  border-bottom-color: white;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.panel-white .panel-heading {
  background: white;
}
.tab-pane ul {
  padding-left: 2em;
}
.tab-pane h1 {
  font-size: 1.3em;
}
.tab-pane h2 {
  font-size: 1.2em;
  padding-bottom: 4px;
  border-bottom: 1px solid #ddd;
}
.tab-pane h3 {
  font-size: 1.1em;
}
.tab-content {
  border-left: 1px solid #ddd;
  border-right: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  padding: 10px;
}
#sidebar {
  margin-top: 30px;
  padding-right: 5px;
  overflow: auto;
  height: 90%;
}
.top-resource-description {
  border-bottom: 1px solid #ddd;
  background: #fcfcfc;
  padding: 15px 15px 0 15px;
  margin: -15px -15px 10px -15px;
}
.resource-description {
  border-bottom: 1px solid #fcfcfc;
  background: #fcfcfc;
  padding: 15px 15px 0 15px;
  margin: -15px -15px 10px -15px;
}
.resource-description p:last-child {
  margin: 0;
}
.list-group .badge {
  float: left;
}
.method_description {
  margin-left: 85px;
}
.method_description p:last-child {
  margin: 0;
}
.list-group-item {
  cursor: pointer;
}
.list-group-item:hover {
  background-color: #f5f5f5;
}
pre code {
  overflow: auto;
  word-wrap: normal;
  white-space: pre;
}
.items {
  background: #f5f5f5;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 9.5px;
  margin: 0 0 10px;
  font-size: 13px;
  line-height: 1.42857143;
}
.examples {
  margin-left: 0.5em;
}
.resource-modal li > ul {
  margin-bottom: 1em;
}
.required {
  color: #f00;
}
    </style></head><body data-spy="scroll" data-target="#sidebar"><div class="container"><div class="row"><div class="col-md-9" role="main"><div class="page-header"><h1>Home Advisor API documentation <small>version v0</small></h1><p>http://3.86.103.202/api/{version}</p><ul><li><strong>version</strong>: <em><span class="required">required</span>(v0)</em></li></ul><h3 id="introduction"><a href="#introduction">Introduction</a></h3><p>A RESTful system that allows a user to set and retrieve information about businesses within our network.</p></div><div class="panel panel-default"><div class="panel-heading"><h3 id="businesses" class="panel-title">/businesses</h3></div><div class="panel-body"><div class="panel-group"><div class="panel panel-white resource-modal"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel_businesses"><span class="parent"></span>/businesses</a> <span class="methods"><a href="#businesses_post"><span class="badge badge_post">post</span></a> <a href="#businesses_put"><span class="badge badge_put">put</span></a></span></h4></div><div id="panel_businesses" class="panel-collapse collapse"><div class="panel-body"><div class="list-group"><div onclick="window.location.href = '#businesses_post'" class="list-group-item"><span class="badge badge_post">post</span><div class="method_description"><p>Retrieve a list of businesses using the parameters provided.</p></div><div class="clearfix"></div></div><div onclick="window.location.href = '#businesses_put'" class="list-group-item"><span class="badge badge_put">put</span><div class="method_description"><p>Add a new business to the database</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="businesses_post"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_post">post</span> <span class="parent"></span>/businesses</h4></div><div class="modal-body"><div class="alert alert-info"><p>Retrieve a list of businesses using the parameters provided.</p></div><ul class="nav nav-tabs"><li class="active"><a href="#businesses_post_request" data-toggle="tab">Request</a></li><li><a href="#businesses_post_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="businesses_post_request"><h3>Body</h3><p><strong>Media type</strong>: application/json</p><p><strong>Type</strong>: object</p><strong>Properties</strong><ul><li><strong>name_contains</strong>: <em>(string)</em><p>Business contains the following text in the name.</p></li><li><strong>buisiness_days_open</strong>: <em>(array of Day - minItems: 1)</em><p>Business is open on all of the specified days in the array.</p></li><li><strong>open_from</strong>: <em>(integer)</em><p>Business is open from this time or earlier. Entered as an integer in 24 hour format.</p></li><li><strong>open_to</strong>: <em>(integer)</em><p>Business is open until this time or later. Entered as an integer in 24 hour format.</p></li><li><strong>jobs</strong>: <em>(array of string - minItems: 1)</em><p>Business performs all of the jobs contained within the array.</p></li><li><strong>location</strong>: <em>(integer)</em><p>Business operates in cities with a geographical location within [radius] of this postal code. If no radius is enteredm default to 25 miles.</p></li><li><strong>radius</strong>: <em>(integer)</em><p>Defined the distance from the Locatoin center point. When included, Location postal code is required.</p></li><li><strong>review_rating</strong>: <em>(number)</em><p>Business has an average review rating greater than or equal to this value</p></li><li><strong>sort_type</strong>: <em>(number - maximum: 1)</em><p>Sort businesses by [0] Name or [1] Average Rating</p></li><li><strong>sort_method</strong>: <em>(number - maximum: 1)</em><p>Sort businesses in [0] Ascending or [1] Descending order</p></li></ul><p><strong>Example</strong>:</p><div class="examples"><pre><code>{
  "name_contains" : "Business",
  "buisiness_days_open" : ["Monday", "Tuesday", "Friday"],
  "open_from" : 7,
  "open_to" : 18,
  "jobs" : ["Maid Service", "House Cleaning", "Moving Services"],
  "location" : 80262,
  "radius" : 50,
  "review_rating" : 4,
  "sort_type" : 1,
  "sort_method" : 1
}
</code></pre></div></div><div class="tab-pane" id="businesses_post_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><h3>Body</h3><p><strong>Media type</strong>: application/json</p><p><strong>Type</strong>: array of object</p><p><strong>Items</strong>: Business</p><div class="items"><ul><li><strong>businessName</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>rating</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>businessHours</strong>: <em><span class="required">required</span>(array of BusinessHour - minItems: 1)</em><p><strong>Items</strong>: BusinessHour</p><div class="items"><ul><li><strong>dayOfWeek</strong>: <em><span class="required">required</span>(string)</em><p>Monday<br>Tuesday<br>Wednesday<br>Thursday<br>Friday<br>Saturday<br>Sunday</p></li><li><strong>open</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>close</strong>: <em><span class="required">required</span>(number)</em></li></ul></div></li><li><strong>businessAddress</strong>: <em><span class="required">required</span>(object)</em><ul><li><strong>addressLine1</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>addressLine2</strong>: <em>(string)</em></li><li><strong>city</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>stateAbbr</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>postal</strong>: <em><span class="required">required</span>(string)</em></li></ul></li><li><strong>operatingCities</strong>: <em><span class="required">required</span>(array of OperatingCity)</em></li><li><strong>workTypes</strong>: <em><span class="required">required</span>(array of WorkType)</em></li><li><strong>reviews</strong>: <em><span class="required">required</span>(array of Review)</em><p><strong>Items</strong>: Review</p><div class="items"><ul><li><strong>ratingScore</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>customerComment</strong>: <em><span class="required">required</span>(string)</em></li></ul></div></li></ul></div><h2>HTTP status code <a href="http://httpstatus.es/401" target="_blank">401</a></h2><h2>HTTP status code <a href="http://httpstatus.es/403" target="_blank">403</a></h2></div></div></div></div></div></div><div class="modal fade" tabindex="0" id="businesses_put"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_put">put</span> <span class="parent"></span>/businesses</h4></div><div class="modal-body"><div class="alert alert-info"><p>Add a new business to the database</p></div><ul class="nav nav-tabs"><li class="active"><a href="#businesses_put_request" data-toggle="tab">Request</a></li><li><a href="#businesses_put_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="businesses_put_request"><h3>Body</h3><p><strong>Media type</strong>: application/json</p><p><strong>Type</strong>: object</p><strong>Properties</strong><ul><li><strong>businessName</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>rating</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>businessHours</strong>: <em><span class="required">required</span>(array of BusinessHour - minItems: 1)</em><p><strong>Items</strong>: BusinessHour</p><div class="items"><ul><li><strong>dayOfWeek</strong>: <em><span class="required">required</span>(string)</em><p>Monday<br>Tuesday<br>Wednesday<br>Thursday<br>Friday<br>Saturday<br>Sunday</p></li><li><strong>open</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>close</strong>: <em><span class="required">required</span>(number)</em></li></ul></div></li><li><strong>businessAddress</strong>: <em><span class="required">required</span>(object)</em><ul><li><strong>addressLine1</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>addressLine2</strong>: <em>(string)</em></li><li><strong>city</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>stateAbbr</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>postal</strong>: <em><span class="required">required</span>(string)</em></li></ul></li><li><strong>operatingCities</strong>: <em><span class="required">required</span>(array of OperatingCity)</em></li><li><strong>workTypes</strong>: <em><span class="required">required</span>(array of WorkType)</em></li><li><strong>reviews</strong>: <em><span class="required">required</span>(array of Review)</em><p><strong>Items</strong>: Review</p><div class="items"><ul><li><strong>ratingScore</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>customerComment</strong>: <em><span class="required">required</span>(string)</em></li></ul></div></li></ul><p><strong>Example</strong>:</p><div class="examples"><p><strong>Businesses</strong>:<br></p><pre><code>{
  "businessName": "Sample Business #1",
  "businessHours": [
    {
      "dayOfWeek": "Monday",
      "open": 9,
      "close": 17
    },
    {
      "dayOfWeek": "Tuesday",
      "open": 9,
      "close": 17
    },
    {
      "dayOfWeek": "Friday",
      "open": 9,
      "close": 17
    }
  ],
  "businessAddress": {
    "addressLine1": "1234 Fake St",
    "addressLine2": "Suite 500",
    "city": "Denver",
    "stateAbbr": "CO",
    "postal": "80210"
  },
  "operatingCities": [
    "Denver",
    "Lakewood",
    "Thornton",
    "Golden",
    "Arvada",
    "Centennial",
    "Parker"
  ],
  "workTypes": [
    "Maid Service",
    "House Cleaning",
    "Moving Services"
  ],
  "reviews": [
    {
      "ratingScore": 4.5,
      "customerComment": "Use them weekly to clean our home. Do a great job every time"
    },
    {
      "ratingScore": 4,
      "customerComment": "Helped us move homes, very timely"
    }
  ]
}</code></pre></div></div><div class="tab-pane" id="businesses_put_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><h3>Body</h3><p><strong>Media type</strong>: application/json</p><p><strong>Type</strong>: object</p><strong>Properties</strong><ul><li><strong>businessName</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>rating</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>businessHours</strong>: <em><span class="required">required</span>(array of BusinessHour - minItems: 1)</em><p><strong>Items</strong>: BusinessHour</p><div class="items"><ul><li><strong>dayOfWeek</strong>: <em><span class="required">required</span>(string)</em><p>Monday<br>Tuesday<br>Wednesday<br>Thursday<br>Friday<br>Saturday<br>Sunday</p></li><li><strong>open</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>close</strong>: <em><span class="required">required</span>(number)</em></li></ul></div></li><li><strong>businessAddress</strong>: <em><span class="required">required</span>(object)</em><ul><li><strong>addressLine1</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>addressLine2</strong>: <em>(string)</em></li><li><strong>city</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>stateAbbr</strong>: <em><span class="required">required</span>(string)</em></li><li><strong>postal</strong>: <em><span class="required">required</span>(string)</em></li></ul></li><li><strong>operatingCities</strong>: <em><span class="required">required</span>(array of OperatingCity)</em></li><li><strong>workTypes</strong>: <em><span class="required">required</span>(array of WorkType)</em></li><li><strong>reviews</strong>: <em><span class="required">required</span>(array of Review)</em><p><strong>Items</strong>: Review</p><div class="items"><ul><li><strong>ratingScore</strong>: <em><span class="required">required</span>(number)</em></li><li><strong>customerComment</strong>: <em><span class="required">required</span>(string)</em></li></ul></div></li></ul><h2>HTTP status code <a href="http://httpstatus.es/400" target="_blank">400</a></h2><h2>HTTP status code <a href="http://httpstatus.es/401" target="_blank">401</a></h2><h2>HTTP status code <a href="http://httpstatus.es/403" target="_blank">403</a></h2></div></div></div></div></div></div></div></div></div></div></div><div class="col-md-3"><div id="sidebar" class="hidden-print affix" role="complementary"><ul class="nav nav-pills nav-stacked"><li><a href="#businesses">/businesses</a></li></ul></div></div></div></div></body></html>