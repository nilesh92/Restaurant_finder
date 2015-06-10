<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
	  
    </style>
    <title>Nearby restaurants</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
var map, placesList, service, infowindow, rad, marker1;

function initialize() {

var pyrmont, location;
var address = "<?php echo $_POST['addr'] ?>";
var rad = "<?php echo $_POST['dist'] ?>";
var geocoder = new google.maps.Geocoder();
infowindow = new google.maps.InfoWindow();

geocoder.geocode( { 'address': address}, function(results, status) {
  location = results[0].geometry.location;
  pyrmont = new google.maps.LatLng(location.lat(), location.lng());
  map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: pyrmont,
    zoom: 20
  });

  marker1 = new google.maps.Marker({
      map: map,
      title: "My position",
      position: pyrmont
    });
	
  var request = {
    location: pyrmont,
    radius: rad,
    types: ['restaurant']
  };

  placesList = document.getElementById('places');

  service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
});

}

function callback(results, status, pagination) {
  if (status != google.maps.places.PlacesServiceStatus.OK) {
    return;
  } else {
    createMarkers(results);

    if (pagination.hasNextPage) {
      var moreButton = document.getElementById('more');

      moreButton.disabled = false;

      google.maps.event.addDomListenerOnce(moreButton, 'click',
          function() {
        moreButton.disabled = true;
        pagination.nextPage();
      });
    }
  }
}

function createMarkers(places) {
  var bounds = new google.maps.LatLngBounds();
  
  

  for (var i = 0, place; place = places[i]; i++) {
    var image = {
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(25, 25)
    };

    
	
	//alert(place.place_id);
	
	var request = { placeId: place.place_id };
    /*service.getDetails(request, function(details, status) {
    google.maps.event.addListener(marker, 'click', function() {
	alert(details.formatted_address);
    infowindow.setContent(details.name + "<br />" + details.formatted_address +"<br />" + details.website + "<br />" + details.rating + "<br />" + details.formatted_phone_number);
    infowindow.open(map, this);
   });
 });
 */
 
 var infowindow1 = new google.maps.InfoWindow();
  var service1 = new google.maps.places.PlacesService(map);

  service1.getDetails(request, function(place, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      var marker = new google.maps.Marker({
      map: map,
      icon: image,
      title: place.name,
      position: place.geometry.location
    });
	
	placesList.innerHTML += '<li>' + place.name + "<br />" + place.formatted_address +"<br />" + "Website: " + place.website + "<br />" + "Rating: " + place.rating + "<br />" + "Phone no.: " + place.formatted_phone_number + '</li>';
      google.maps.event.addListener(marker, 'click', function() {
        infowindow1.setContent(place.name + "<br />" + place.formatted_address +"<br />" + "Website: " + place.website + "<br />" + "Rating: " + place.rating + "<br />" + "Phone no.: " + place.formatted_phone_number);
        infowindow1.open(map, this);
		
		//placesList.innerHTML += '<li>' + place.name + "<br />" + place.formatted_address +"<br />" + "Website: " + place.website + "<br />" + "Rating: " + place.rating + "<br />" + "Phone no.: " + place.formatted_phone_number + '</li>';
      });
    }
  });

    

    bounds.extend(place.geometry.location);
  }
  map.fitBounds(bounds);
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style>
      #results {
        font-family: Arial, Helvetica, sans-serif;
        position: absolute;
        right: 0%;
        height: 98%;
        width: 60%;
        padding: 0px;
        z-index: 5;
        border: 1px solid #999;
        background: #fff;
      }
      h2 {
	    padding-left: 10px;
        font-size: 22px;
        margin: 0 0 5px 0;
      }
      ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        height: 90%;
        width: 100%;
        overflow-y: scroll;
      }
      li {
        background-color: #f1f1f1;
        padding: 10px;
        word-wrap: break-word;
      }
      li:nth-child(odd) {
        background-color: #fcfcfc;
      }
      #more {
        width: 100%;
        margin: 5px 0 0 0;
      }
    </style>
  </head>
  <body>


	<div style="height:100%; width: 40%; left:0px; position:absolute;">
	<div id="map-canvas"></div>
	</div>
	
	<div id="results">
      <h2>Results</h2>
	  <nav style="position:absolute; top:0%; right: 0%;">
      <ul class='pager'>
      <li class='previous'>
      <a href='home.php'> Back to home</a>
      </li>
      </ul>
      </nav>
      <ul id="places"></ul>
      <button id="more" class="btn btn-info">More results</button>
    </div>
	
	
  </body>
</html>