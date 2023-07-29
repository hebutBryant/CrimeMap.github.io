import Map from 'ol/Map.js';
import Overlay from 'ol/Overlay.js';
import TileLayer from 'ol/layer/Tile.js';
import View from 'ol/View.js';
import XYZ from 'ol/source/XYZ.js';
import {toLonLat} from 'ol/proj.js';
import {toStringHDMS} from 'ol/coordinate.js';

/**
 * Elements that make up the popup.
 */
const container = document.getElementById('popup');
const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');

/**
 * Create an overlay to anchor the popup to the map.
 */
const overlay = new Overlay({
    element: container,
    autoPan: {
        animation: {
            duration: 250,
        },
    },
});

/**
 * Add a click handler to hide the popup.
 * @return {boolean} Don't follow the href.
 */
closer.onclick = function () {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
};

/**
 * Add a click handler to the map to render the popup.
 */
map.on('singleclick', function (evt) {
    const coordinate = evt.coordinate;
    const hdms = toStringHDMS(toLonLat(coordinate));

    content.innerHTML = '<p>You clicked here:</p><code>' + hdms + '</code>';
    overlay.setPosition(coordinate);
});
