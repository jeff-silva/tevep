<template>
    <div>
        <nuxt-layout name="admin">
            <ui-crud namespace="places" :actions-except="['clone', 'delete']">
                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.formatted }}</div>
                        <div class="font-weight-thin">{{ [item.city, item.state, item.country].filter(item => item).join(', ') }}</div>
                    </td>
                </template>
                
                <!-- <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download"></v-btn>
                </template> -->

                <template #edit-fields="{item}">
                    <v-row>
                        <v-col cols="8"><v-text-field class="ma-0" label="Rua" v-model="item.route"></v-text-field></v-col>
                        <v-col cols="4"><v-text-field class="ma-0" label="Nº" v-model="item.number"></v-text-field></v-col>
                        <v-col cols="6"><v-text-field class="ma-0" label="Complemento" v-model="item.complement"></v-text-field></v-col>
                        <v-col cols="6"><v-text-field class="ma-0" label="CEP" v-model="item.zipcode"></v-text-field></v-col>
                        <v-col cols="4"><v-text-field class="ma-0" label="Bairro" v-model="item.district"></v-text-field></v-col>
                        <v-col cols="4"><v-text-field class="ma-0" label="Cidade" v-model="item.city"></v-text-field></v-col>
                        <v-col cols="4"><v-text-field class="ma-0" label="Estado" v-model="item.state"></v-text-field></v-col>

                        <v-col cols="12">
                            <l-map ref="map" :zoom="18" :center="[(item.lat||0), (item.lng||0)]" style="height:350px;">
                                <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                                <l-marker :lat-lng="[(item.lat||0), (item.lng||0)]" :draggable="false" @update:lat-lng="updateLatLng($event)"></l-marker>
                            </l-map>
                        </v-col>
                    </v-row>
                </template>
            </ui-crud>
        </nuxt-layout>
    </div>
</template>