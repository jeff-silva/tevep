// require('dotenv').config({ path: '../.env' });

import { defineNuxtPlugin } from '#app';
import axios from 'axios';

import '@mdi/font/css/materialdesignicons.css';

import { createVuetify } from 'vuetify';
import * as vuetifyComponents from 'vuetify/components';

import 'leaflet/dist/leaflet.css'
import * as leafletComponents from '@vue-leaflet/vue-leaflet';

const devMode = process.env.NODE_ENV !== 'production';

// value.filesizeHuman()
// String.prototype.filesizeHuman = Number.prototype.filesizeHuman = function() {
//     let size = +this;
//     if (!size) return '0Kb';
//     let i = Math.floor( Math.log(size) / Math.log(1024) );
//     return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
// };

// // '1986-02-11 00:15:23'.dateHuman()
// String.prototype.dateHuman = function(format='DD/MM/YYYY - HH:mm') {
//     return useDateFormat(this, format).value;
// };

export default defineNuxtPlugin((nuxtApp) => {
    const vuetify = createVuetify({
        components: vuetifyComponents,
        icons: { defaultSet: 'mdi' },
    });
    
    nuxtApp.vueApp.use(vuetify);
    
    nuxtApp.vueApp.config.globalProperties.$filters = {
        dateHuman(value, format='DD/MM/YYYY - HH:mm') {
            return useDateFormat(value, format).value;
        },
        filesizeHuman(value) {
            if (!value || isNaN(value)) return '0kB';
            let i = Math.floor( Math.log(+value) / Math.log(1024) );
            return ( +value / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        },
    };

    for(let i in leafletComponents) {
        nuxtApp.vueApp.component(i, leafletComponents[i]);
    }
    
    axios.interceptors.request.use(config => {
        if (devMode && (config.url||'').startsWith('/api')) {
            const access_token = localStorage.getItem('access_token') || false;
            if (access_token) {
                config.headers = config.headers || {};
                config.headers['Authorization'] = `Bearer ${access_token}`;
            }
        }

        return config;
    });

    nuxtApp.provide('axios', axios);
    nuxtApp.provide('devMode', devMode);
    nuxtApp.provide('log', console.log);
    
    nuxtApp.provide('helpers', {
        singularPlural(number, singular, plural) {
            return number==1? singular: plural;
        },
        confirm(message) {
            return new Promise((resolve, reject) => {
                let modal = Object.assign(document.createElement('div'), {
                    innerHTML: `<div class="modal-confirm-no" style="position:absolute; top:0; left:0; width:100%; height:100%; background:#00000022; z-index:9999; display:flex; align-items:center; justify-content:center;">
                        <div class="v-card v-theme--light v-card--density-default v-card--variant-contained mx-auto" style="min-width:300px; max-width:300px;">
                            <div class="v-card-text">${message}</div>
                            <div class="v-card-actions">
                                <button type="button" class="modal-confirm-yes v-btn v-theme--light bg-primary v-btn--density-default v-btn--size-default v-btn--variant-text">
                                    Sim
                                </button>
                                <button type="button" class="modal-confirm-no v-btn v-theme--light v-btn--density-default v-btn--size-default v-btn--variant-text">
                                    Não
                                </button>
                            </div>
                        </div>
                    </div>`,
                });

                modal.querySelectorAll('.modal-confirm-no').forEach(elem => {
                    elem.addEventListener('click', ev => {
                        document.body.removeChild(modal);
                    });
                });
                
                modal.querySelectorAll('.modal-confirm-yes').forEach(elem => {
                    elem.addEventListener('click', ev => {
                        document.body.removeChild(modal);
                        setTimeout(() => resolve(), 500);
                    });
                });

                document.body.appendChild(modal);
            });
        },
    });
});