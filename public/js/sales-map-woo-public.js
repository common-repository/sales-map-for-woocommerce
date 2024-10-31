(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    let map;

    jQuery(document).ready(function() {
        initMap();
    });

    function initMap() {
        const map = new google.maps.Map(document.getElementById("sgitswcs_map"), {
            zoom: parseFloat(document.getElementById('sgitswcsm_zoom_level').value),
            zoomControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false,
            center: JSON.parse(document.getElementById("sgitswcsm_latlng").value)[0],
        });
        // Create an array of alphabetical characters used to label the markers.
        const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        const locations = JSON.parse(document.getElementById("sgitswcsm_locations").value);
        const markers = locations.map((location, i) => {
            return new google.maps.Marker({
                position: location,
                label: labels[i % labels.length],
            });
        });
        // Add a marker clusterer to manage the markers.
        new MarkerClusterer(map, markers, {
            imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
        });
    }


})(jQuery);