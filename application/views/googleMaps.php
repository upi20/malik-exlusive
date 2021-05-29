<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete and Directions</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #tetapkan {
        background: #4d90fe;
        color: white;
        width: 80px;
        height: 30px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #tetapkan:hover {
        background: #fff;
        color: black;
        border-radius: 10px;
        width: 80px;
        height: 30px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); 
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
      }

      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #origin-input,
      #destination-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 200px;
      }

      #origin-input:focus,
      #destination-input:focus {
        border-color: #4d90fe;
      }

      #mode-selector {
        color: #fff;
        background-color: #4d90fe;
        margin-left: 12px;
        padding: 5px 11px 0px 11px;
      }

      #mode-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

    </style>
  </head>
  <body>
    <div style="display: none">
        <input id="origin-input" class="controls" type="text"
            placeholder="Enter an origin location">

        <input id="destination-input" class="controls" type="text"
            placeholder="Enter a destination location">

        <div id="mode-selector" class="controls">
          <input type="radio" name="type" id="changemode-walking" checked="checked">
          <label for="changemode-walking">Walking</label>

          <input type="radio" name="type" id="changemode-transit">
          <label for="changemode-transit">Transit</label>

          <input type="radio" name="type" id="changemode-driving">
          <label for="changemode-driving">Driving</label>
          <br><br><br>
          <form method="post" action="<?= base_url() ?>penjualan/maps/setMaps">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="tempatAwal" id="tempatAwal" value="" required="">
            <input type="hidden" name="tempatAkhir" id="tempatAkhir" value="" required="">
            <input type="hidden" name="kiri" id="kiri" value="" required="">
            <input type="hidden" name="kanan" id="kanan" value="" required="">
            <input type="submit" id="tetapkan" value="Tetapkan">
          </form>
        </div>
    </div>

    <div id="map"></div>
    <script>
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initMap() {
  if("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
      let latitude = position.coords.latitude;
      let longitude = position.coords.longitude;

      var map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: {lat: latitude, lng: longitude },
        zoom: 13
      });

      new AutocompleteDirectionsHandler(map);

    });
  }
}

/**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
  this.map = map;
  this.originPlaceId = null;
  this.destinationPlaceId = null;
  this.travelMode = 'WALKING';
  this.directionsService = new google.maps.DirectionsService;
  this.directionsDisplay = new google.maps.DirectionsRenderer;
  this.directionsDisplay.setMap(map);

  var originInput = document.getElementById('origin-input');
  var destinationInput = document.getElementById('destination-input');
  var modeSelector = document.getElementById('mode-selector');

  var originAutocomplete = new google.maps.places.Autocomplete(originInput);
  // Specify just the place data fields that you need.
  originAutocomplete.setFields(['place_id']);

  var destinationAutocomplete =
      new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.
  destinationAutocomplete.setFields(['place_id']);

  this.setupClickListener('changemode-walking', 'WALKING');
  this.setupClickListener('changemode-transit', 'TRANSIT');
  this.setupClickListener('changemode-driving', 'DRIVING');

  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
      destinationInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
AutocompleteDirectionsHandler.prototype.setupClickListener = function(
    id, mode) {
  var radioButton = document.getElementById(id);
  var me = this;

  radioButton.addEventListener('click', function() {
    me.travelMode = mode;
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
  var me = this;
  autocomplete.bindTo('bounds', this.map);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.place_id) {
      window.alert('Please select an option from the dropdown list.');
      return;
    }
    let kiri;
    let kanan;

    if (mode === 'ORIG') {
      me.originPlaceId = place.place_id;
      kiri = place.place_id;
      document.getElementById('kiri').value=kiri;
      document.getElementById('tempatAwal').value=document.getElementById('origin-input').value;
    } else {
      me.destinationPlaceId = place.place_id;
      kanan = place.place_id;
      document.getElementById('kanan').value=kanan;
      document.getElementById('tempatAkhir').value=document.getElementById('destination-input').value;
    }

    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.route = function() {
  if (!this.originPlaceId || !this.destinationPlaceId) {
    return;
  }
  var me = this;

  this.directionsService.route(
      {
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode
      },
      function(response, status) {
        if (status === 'OK') {
          me.directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
};

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Xd4GJtDxGPUI7nlMV-I99x5EQqYqhGc&callback=initialize&libraries=places&callback=initMap"
        async defer></script>
  </body>
</html>