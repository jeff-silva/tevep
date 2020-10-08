<template><div class="ui-address" style="position:relative; z-index:1;">
    <div class="row">
        <div class="col-8 col-md-8">
            <div class="input-group form-control border-0 p-0">
                <div class="input-group-prepend"><div class="input-group-text border-0" style="width:100px;">
                    CEP
                </div></div>
                <input type="text" class="form-control border-0" v-model="props.value.zipcode" @keyup="emit(); autocomplete({delay:500, isSearch:false, type:'zipcode'});">
            </div>
        </div>

        <div class="col-12"></div>

        <div class="col-12 col-md-8">
            <div class="input-group form-control border-0 p-0" style="height:auto;">
                <div class="input-group-prepend"><div class="input-group-text border-0" style="width:100px;">
                    Endereço
                </div></div>
                <input type="text" class="form-control border-0" v-model="props.value.route"
                    placeholder="Digite endereço, bairro e cidade para autocompletar"
                    @keyup="autocomplete({delay:500, isSearch:true, type:'address'})"
                    @change="emit()">
            </div>
            <div style="position:relative;">
                <div class="bg-white shadow-sm" style="position:absolute; top:0px; left:0px; z-index:9; max-height:40vh; overflow:auto;">
                    <div v-for="r in search.results" class="p-2 ui-address-search-results-each" @click="selectPlace(r);">
                        {{ r.display_name }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="input-group form-control border-0 p-0">
                <div class="input-group-prepend"><div class="input-group-text border-0" style="width:100px;">
                    Número
                </div></div>
                <input type="text" class="form-control border-0" v-model="props.value.number" @change="emit()">
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="input-group form-control border-0 p-0" title="Complemento">
                <div class="input-group-prepend"><div class="input-group-text border-0" style="width:100px;">
                    Comp.
                </div></div>
                <input type="text" class="form-control border-0" v-model="props.value.complement" @change="emit()">
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="input-group form-control border-0 p-0">
                <div class="input-group-prepend"><div class="input-group-text border-0" style="width:100px;">
                    Cidade
                </div></div>
                <input type="text" class="form-control border-0" v-model="props.value.city" @keyup="autocomplete({delay:500, isSearch:true, type:'address'})" @change="emit()">
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="input-group form-control border-0 p-0">
                <div class="input-group-prepend"><div class="input-group-text border-0" style="width:100px;">
                    Estado
                </div></div>
                <select class="form-control border-0" v-model="props.value.st" @change="emit()">
                    <option value="">Selecionar</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
        </div>
    </div>

    <l-map :zoom="16" :center="[(props.value.lat||0), (props.value.lng||0)]" style="height:200px;">
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
        <l-marker :lat-lng="[(props.value.lat||0), (props.value.lng||0)]" :draggable="true" @moveend="getAddressByLatLng($event)"></l-marker>
    </l-map>
</div></template>

<script>
let autocompleteTimeout;
export default {
    props: {
        value: {default: () => ({})},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
            },
        },
    },

    computed: {
        formattedAddress() {
            let addr=this.props.value, parts=[];
            if (addr.route) parts.push(addr.route);
            if (addr.number) parts.push(`Nº ${addr.number}`);
            if (addr.complement) parts.push(addr.complement);
            if (addr.zipcode) parts.push(`CEP ${addr.zipcode}`);
            if (addr.district) parts.push(addr.district);
            if (addr.city) parts.push(addr.city);
            if (addr.state) parts.push(addr.state);
            return parts.join(', ');
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        selectPlace(place) {
            if (Object.keys(place).length==0) return;

            let states = {
                "Acre": "AC",
                "Alagoas": "AL",
                "Amapá": "AP",
                "Amazonas": "AM",
                "Bahia": "BA",
                "Ceará": "CE",
                "Distrito Federal": "DF",
                "Espírito Santo": "ES",
                "Goiás": "GO",
                "Maranhão": "MA",
                "Mato Grosso": "MT",
                "Mato Grosso do Sul": "MS",
                "Minas Gerais": "MG",
                "Pará": "PA",
                "Paraíba": "PB",
                "Paraná": "PR",
                "Pernambuco": "PE",
                "Piauí": "PI",
                "Rio de Janeiro": "RJ",
                "Rio Grande do Norte": "RN",
                "Rio Grande do Sul": "RS",
                "Rondônia": "RO",
                "Roraima": "RR",
                "Santa Catarina": "SC",
                "São Paulo": "SP",
                "Sergipe": "SE",
                "Tocantins": "TO",
            };

            this.props.value = Object.assign(this.props.value, {
                lat: (place.lat? parseFloat(place.lat): 0),
                lng: (place.lon? parseFloat(place.lon): 0),
                route: place.address.road,
                number: '',
                complement: '',
                zipcode: place.address.postcode,
                district: place.address.suburb,
                city: place.address.city,
                state: place.address.state,
                st: (states[place.address.state]||false),
                country: place.address.country,
                co: place.address.country_code.toUpperCase(),
            });

            this.$set(this.props, 'value', this.props.value);
            this.$set(this.search, 'results', []);
            this.emit();
        },

        autocomplete(params={}) {
            params = Object.assign({
                delay: 0,
                isSearch: true,
                type: 'zipcode',
            }, params);

            if (autocompleteTimeout) clearTimeout(autocompleteTimeout);
            autocompleteTimeout = setTimeout(() => {
                let params2 = {};
                if (params.type=='address') {
                    params2.q = `${this.props.value.route} ${this.props.value.district} ${this.props.value.city}`.trim();
                }
                else if (params.type=='zipcode') {
                    params2.zipcode = this.props.value.zipcode;
                }
                else if (params.type=='latlng') {
                    params2.lat = this.props.value.lat;
                    params2.lng = this.props.value.lng;
                }
                
                this.$axios.get('/api/addresses/autocomplete/', {params:params2}).then((resp) => {
                    this.loading = false;
                    if (params.isSearch) { this.$set(this.search, 'results', resp.data); }
                    else { this.selectPlace(resp.data[0]||{}); }
                });
            }, params.delay);
        },

        getAddressByLatLng(ev) {
            this.props.value.lat = ev.target._latlng.lat;
            this.props.value.lng = ev.target._latlng.lng;
            this.autocomplete({delay:0, isSearch:false, type:'latlng'});
        },

        documentClickHandle(ev) {
            this.focused = this.$el.contains(ev.target);
        },
    },

    data() {
        let data = {};

        data.loading = false;
        data.focused = false;
        data.search = {
            params: {
                q: "",
                format: "json",
                addressdetails: 1,
            },
            results: [],
        };

        data.props = Object.assign({}, this.$props);
        data.props.value = Object.assign({
            lat: 0,
            lng: 0,
            route: '',
            number: '',
            complement: '',
            zipcode: '',
            district: '',
            city: '',
            state: '',
            st: '',
            country: '',
            co: '',
        }, data.props.value);

        return data;
    },

    mounted() {
        window.addEventListener('click', this.documentClickHandle);
    },

    beforeDestroy() {
        window.removeEventListener('click', this.documentClickHandle);
    },
};</script>


<style>
.ui-address .leaflet-pane {z-index:1 !important;}
.ui-address-search-results-each {border-bottom:solid 1px #eee;}
.ui-address-search-results-each:hover {background:#eee; cursor:pointer;}
</style>