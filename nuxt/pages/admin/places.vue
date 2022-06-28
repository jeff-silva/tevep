<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="places"
                singular="Endereço"
                plural="Endereços"
                :item-actions="{delete:false}"
                @search-result="searchResult($event)"
            >
                <template #search-header="crud">
                    <l-map ref="map" :zoom="18" :center="[0, 0]" style="height:300px;">
                        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                        <l-marker
                            v-for="m in crud.search.resp.data"
                            :key="$key(m)"
                            :lat-lng="[(m.lat||0), (m.lng||0)]"
                        ></l-marker>
                    </l-map>
                </template>

                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{ item }">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">{{ [item.city, item.state, item.country].filter(item => item).join(', ') }}</div>
                    </td>
                </template>

                <template #search-drawer="crud">
                    <template v-if="crud.search.resp && crud.search.resp.attributes">
                        <v-select
                            label="País"
                            v-model="crud.search.params.country_short"
                            :items="vuetifyItems(crud.search.resp.attributes.countries, 'country_short', 'country')"
                            @update:modelValue="crud.search.params.state_short=null; crud.search.submit()"
                            hide-details
                        >
                        </v-select>

                        <v-select
                            label="Estado"
                            v-model="crud.search.params.state_short"
                            :items="vuetifyItems(crud.search.resp.attributes.states, 'state_short', 'state')"
                            @update:modelValue="crud.search.submit()"
                            v-if="crud.search.resp.attributes.states.length"
                            hide-details
                        >
                        </v-select>
                    </template>
                </template>

                <template #edit-fields="crud">
                    <app-model-place
                        v-model="crud.edit"
                        return-type="object"
                        :auto-save="false"
                        @update:modelValue="crud.editUpdate($event)"
                    ></app-model-place>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>

<script>
import L from 'leaflet';

export default {
    methods: {
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

        searchResult($event) {
            this.mapCenter($event.resp.data.data);
        },

        mapCenter(items) {
            const bounds = items.map(place => [+place.lat, +place.lng])
                .filter(bound => !!bound[0] && !!bound[1]);
            if (bounds.length==0 || !map.leafletObject) return;
            console.log(JSON.stringify(bounds, ' ', 2));
            try {
                const map = {...this.$refs.map};
                map.leafletObject.fitBounds(bounds);
            }
            catch(err) {}
        },
	},
}
</script>