<template><div>
    <business-search style="width:100vw; height:100vh;">
        <template #map="{marker, setPlace}">
            <l-marker :lat-lng="[marker.lat, marker.lng]">
                <l-icon v-if="marker.category_photo">
                    <img :src="marker.category_photo" alt="" style="width:35px; height:35px; animation-duration:200ms;" class="animate__animated animate__flipInX">
                </l-icon>
                <l-popup class="bg-white animate__animated animate__flipInX" style="width:300px; border-radius:5px; overflow:hidden;">
                    <div class="row no-gutters">
                        <div class="col-6 p-2">
                            <div class="mb-1 font-weight-bold text-uppercase">{{ marker.name }}</div>
                            <div class="mb-1 font-weight-bold">{{ marker.category_name }}</div>
                            <div class="mb-2 text-muted" style="max-height:120px; overflow:auto;">{{ marker.description }}</div>
                        </div>
                        <div class="col-6 p-2">
                            <img :src="marker.photo||marker.category_photo" alt="" style="width:100%;" class="">
                        </div>
                    </div>
                    <nuxt-link :to="`/business/${marker.id}`" class="btn btn-primary btn-block btn-sm m-0 mt-2" @click.native="business=marker;">
                        Detalhes
                    </nuxt-link>
                </l-popup>
            </l-marker>
        </template>
    </business-search>

    <div class="bg-white shadow-sm" style="position:fixed; bottom:0px; left:0px; width:100%; max-height:40vh; overflow:auto; z-index:9999!important">
        <div v-if="$route.params.id">
            <nuxt-child keep-alive v-model="business"></nuxt-child>
        </div>
    </div>
</div></template>

<script>
let eventMapUpdateBoundsTimeout;
export default {
    data() {
        let data = {};
        data.loading = false;
        data.map = {
            zoom: 16,
            minZoom: 13,
            maxZoom: 16,
            center:[0, 0],
        };
        data.productTypes = this.modelDefault('productTypes');
        data.productCategories = this.modelDefault('productCategories');
        data.markers = [];
        data.business = {};
        return data;
    },
};</script>
