<template>

  <div style="height: 650px;">
    <div class="info" style="height: 15%">
      <span>Center: {{ center }}</span>
      <span>Zoom: {{ zoom }}</span>
    </div>
    <l-map
      style="height: 80%; width: 100%"
      :zoom="zoom"
      :center="center"
      @update:zoom="zoomUpdated"
      @update:center="centerUpdated"
    >
      <l-tile-layer :url="url"></l-tile-layer>
      <v-geosearch :options="geosearchOptions" ></v-geosearch>
      <l-control position="bottomleft" >
        <button @click="addMarker">
          I am a useless button!
        </button>
      </l-control>
      <l-marker :lat-lng="markerLatLng" ></l-marker>
    </l-map>
  </div>
</template>

<script>
import {LMap, LTileLayer, LControl, LMarker} from 'vue2-leaflet';

import Vue2Leaflet from 'vue2-leaflet';
import { OpenStreetMapProvider } from 'leaflet-geosearch';
import VGeosearch from 'vue2-leaflet-geosearch';

export default {
  components: {
    LMap,
    LTileLayer,
    VGeosearch,
    LControl,
    LMarker,
  },
  data () {
    return {
      // url: 'https://tile.thunderforest.com/pioneer/{z}/{x}/{y}.png?apikey=1b27a521aadd47ffa58edc836391d5b9',
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      zoom: 18,
      center: [47.547545, 7.622059],
       geosearchOptions: {
         provider: new OpenStreetMapProvider(),
         style: 'bar',
         showMarker: false,
      },
          markers: []
    };
  },
  methods: {
    addMarker() {
      this.markers.push(L.latLng(this.center));
    },

    zoomUpdated (zoom) {
      this.zoom = zoom;
    },
    centerUpdated (center) {
      this.center = center;
    },
     clickHandler () {
      window.alert('NO GODS NO RULES')
    },
    // boundsUpdated (bounds) {
    //   this.bounds = bounds;
    // }
  }
}
</script>

<style>
</style>
