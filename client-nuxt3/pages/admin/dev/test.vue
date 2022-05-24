<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <form @submit.prevent="user.submit()">
                    <v-text-field label="Descrição" v-model="user.data.name" :error-messages="user.errorField('name')"></v-text-field>
                    <v-text-field label="Descrição" v-model="user.data.name" :rules="[rules.required, rules.email]" :error-messages="user.errorField('name')" v-imask="'+{7}(000)000-00-00'"></v-text-field>
                    <v-btn type="submit" :loading="user.loading">Salvar</v-btn>
                </form>

                <!-- <l-map ref="map" :zoom="18" :center="placeCoords" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="placeCoords"></l-marker>
                </l-map>
                <pre>placeCoords: {{ placeCoords }}</pre>
                <pre>battery: {{ battery }}</pre>
                <pre>geolocation: {{ geolocation }}</pre> -->

                <pre>$data: {{ $data }}</pre>
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
            user: useAxios({
                method: 'post',
                url: '/api/users/save',
                data: {},
            }),

            rules: {
                required: value => !!value || 'Required.',
                counter: value => value.length <= 20 || 'Max 20 characters',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'Invalid e-mail.'
                },
            },

            // battery: useBattery(),
            // deviceMotion: useDeviceMotion(),
            // geolocation: useGeolocation(),
            // permission: {
            //     accelerometer: usePermission('accelerometer'),
            //     accessibilityEvents: usePermission('accessibilityEvents'),
            //     ambientLightSensor: usePermission('ambientLightSensor'),
            //     backgroundSync: usePermission('backgroundSync'),
            //     camera: usePermission('camera'),
            //     clipboardRead: usePermission('clipboardRead'),
            //     clipboardWrite: usePermission('clipboardWrite'),
            //     gyroscope: usePermission('gyroscope'),
            //     magnetometer: usePermission('magnetometer'),
            //     microphone: usePermission('microphone'),
            //     notifications: usePermission('notifications'),
            //     paymentHandler: usePermission('paymentHandler'),
            //     persistentStorage: usePermission('persistentStorage'),
            //     push: usePermission('push'),
            //     speaker: usePermission('speaker'),
            // },
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