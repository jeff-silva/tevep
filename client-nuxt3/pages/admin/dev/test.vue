<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <l-map ref="map" :zoom="18" :center="placeCoords" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="placeCoords"></l-marker>
                </l-map>
                <pre>placeCoords: {{ placeCoords }}</pre>
                <!-- <pre>coords.latitude: {{ {
                    accuracy: geolocation.coords.accuracy,
                    latitude: geolocation.coords.latitude,
                    longitude: geolocation.coords.longitude,
                    altitude: geolocation.coords.altitude,
                    altitudeAccuracy: geolocation.coords.altitudeAccuracy,
                    heading: geolocation.coords.heading,
                    speed: geolocation.coords.speed,
                } }}</pre> -->
                <!-- <pre>{{ $data }}</pre> -->
                <pre>battery: {{ battery }}</pre>
                <pre>geolocation: {{ geolocation }}</pre>
            </v-container>
        </nuxt-layout>
    </div>
</template>

<script>
import {
    useBattery,
    useGeolocation,
    usePermission,
} from '@vueuse/core';

export default {
    data() {
        return {
            battery: useBattery(),
            deviceMotion: useDeviceMotion(),
            geolocation: useGeolocation(),
            permission: {
                accelerometer: usePermission('accelerometer'),
                accessibilityEvents: usePermission('accessibilityEvents'),
                ambientLightSensor: usePermission('ambientLightSensor'),
                backgroundSync: usePermission('backgroundSync'),
                camera: usePermission('camera'),
                clipboardRead: usePermission('clipboardRead'),
                clipboardWrite: usePermission('clipboardWrite'),
                gyroscope: usePermission('gyroscope'),
                magnetometer: usePermission('magnetometer'),
                microphone: usePermission('microphone'),
                notifications: usePermission('notifications'),
                paymentHandler: usePermission('paymentHandler'),
                persistentStorage: usePermission('persistentStorage'),
                push: usePermission('push'),
                speaker: usePermission('speaker'),
            },
        };
    },

    computed: {
        placeCoords() {
            return [
                this.geolocation.coords.latitude,
                this.geolocation.coords.longitude,
            ];
        },
    },
};
</script>