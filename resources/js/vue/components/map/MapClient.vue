<template>
    <v-row>
        <v-col cols="12" sm="12">
            <h2>Seguimiento</h2>
        </v-col>
    </v-row>
    <v-row>
        <v-col cols="6" sm="6">
            <v-text-field v-model="codeSearch" label="Insert Code" outlined clearable></v-text-field>
        </v-col>
        <v-col cols="6" sm="6">
            <v-btn x-large color="primary" dark @click="updateMap">
                Search
            </v-btn>
        </v-col>
    </v-row>

    <div style="z-index: -1; height: 75vh; width: 100%;">
        <l-map v-model="zoom" v-model:zoom="zoom" :center="initialCoordinate" :key="mapKey">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'>
            </l-tile-layer>
            <l-marker :lat-lng="coordinates" />
            <l-polyline :lat-lngs="polyline.latlngs" :color="polyline.color" :visible="true" :key="polyline.key">
                <l-popup content="polyline" />
            </l-polyline>
            <l-circle 
            :lat-lng="initialCoordinate" 
            :radius="5000" 
            color="green" />

        </l-map>
    </div>
</template>
<script>
import {
    LMap,
    LIcon,
    LTileLayer,
    LMarker,
    LTooltip,
    LPopup,
    LPolyline,
    LCircle
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";

export default {
    components: {
        LMap,
        LIcon,
        LTileLayer,
        LMarker,
        LTooltip,
        LPopup,
        LPolyline,
        LCircle
    },
    data() {
        return {
            mapKey:0,
            init: true,
            initialCoordinate: [0, 0],
            coordinates: [0, 0],
            polylineCoordinates: [],
            polyline: {
                key: 0,
                latlngs: [],
                color: 'orange'
            },
            zoom: 13,
            codeSearch:0,
            trakins:[]
        };
    },
    async mounted() {

    },
    methods: {
        updateMap() {
            this.$axios.get(`/api/getTrackinByTravel/${this.codeSearch}`).then((res) => {
                var data = res.data;
                data.forEach(track => {
                    this.trakins.push([track.latitude,track.longitude]);
                });
                this.drawPolyline();
                this.refreshMap();
                console.log(this.trakins)
            });
            
        },
        drawPolyline() {
            this.polyline.key += 1;
            this.polyline.latlngs = this.trakins;
        },
        searchTrackCode() {
            this.updateMap();
        },
        refreshMap(){
            this.mapKey +=1;
        }
    },
};
</script>