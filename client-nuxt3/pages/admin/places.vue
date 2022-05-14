<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="places"
                singular="Endereço"
                plural="Endereços"
                :actions-except="['clone', 'delete']"
                @search="handleFormResponse($event)"
            >
                <template #search-header="crud">
                    <v-card v-if="crud.search.resp">
                        <v-card-text>
                            <!-- <pre>{{ crud.search.resp }}</pre> -->
                            <l-map ref="map" :zoom="18" :center="[0, 0]" style="height:300px;">
                                <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                                <template v-for="m in crud.search.resp.data">
                                    <l-marker :lat-lng="[(m.lat||0), (m.lng||0)]"></l-marker>
                                </template>
                            </l-map>
                        </v-card-text>
                    </v-card>
                </template>

                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">{{ [item.city, item.state, item.country].filter(item => item).join(', ') }}</div>
                    </td>
                </template>

                <template #search-fields="crud">
                    <template v-if="crud.search.resp">
                        <v-select
                            label="País"
                            v-model="crud.search.params.country_short"
                            :items="vuetifyItems(crud.search.resp.attributes.countries, 'country_short', 'country')"
                            @update:modelValue="crud.search.params.state_short=null; crud.searchSubmit()"
                        >
                        </v-select>

                        <v-select
                            label="Estado"
                            v-model="crud.search.params.state_short"
                            :items="vuetifyItems(crud.search.resp.attributes.states, 'state_short', 'state')"
                            @update:modelValue="crud.searchSubmit()"
                            v-if="crud.search.resp.attributes.states.length"
                        >
                        </v-select>
                        <!-- <pre>{{ crud.search.resp.attributes.states }}</pre> -->
                    </template>
                </template>
                
                <!-- <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download"></v-btn>
                </template> -->

                <template #edit-fields="crud">
                    <app-model-place v-model="crud.edit" :auto-save="false" @update:modelValue="crud.editUpdate($event)"></app-model-place>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>

<script>
import L from 'leaflet';

export default {
    methods: {
		handleFormResponse(crud) {
            // setTimeout(() => {
            //     try {
            //         const map = {...this.$refs.map};
            //         const bounds = crud.search.resp.data
            //             .map(place => [place.lat, place.lng])
            //             .filter(bound => bound[0] && bound[1]);
            //         if (bounds.length==0 || !map.leafletObject) return;
            //         map.leafletObject.fitBounds(bounds);
            //     }
            //     catch(err) {}
            // }, 1000);
		},

        vuetifyItems(items, value, title) {
            let newItems =[{value:null, title:'Todos'}];

            items.forEach(item => {
                newItems.push({
                    value: item[value],
                    title: item[title],
                });
            });

            return newItems;
        },
	},
}
</script>