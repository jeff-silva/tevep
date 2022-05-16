<template>
    <div>
        <v-row>
            <v-col cols="12" md="12">
                <v-text-field
                    :label="placeSave.data.name || label"
                    hide-details
                    v-model="places.params.q"
                    @keyup="places.submit({debounce:1500})"
                    @focus="placesListShow=true"
                    prepend-icon="mdi-magnify"
                    :loading="places.loading"
                ></v-text-field>
                <div style="position:relative; z-index:2;" v-if="placesListShow">
                    <v-card style="background:#fff; position:absolute; width:100%;">
                        <v-list max-height="300px">
                            <v-list-item v-if="places.loading && places.resp.length==0">
                                Carregando resultados
                            </v-list-item>
                            <v-list-item v-if="!places.loading && places.resp.length==0">
                                Nenhum item
                            </v-list-item>
                            <v-list-item v-for="(p, i) in places.resp" :key="i" @click="setPlace(p)">
                                {{ [p.route, p.district, p.city, p.state, p.country].filter(item => item).join(', ') }}
                            </v-list-item>
                        </v-list>
                    </v-card>
                </div>
            </v-col>

            <v-col cols="12" md="8">
                <v-text-field
                    label="Rua"
                    hide-details
                    v-model="placeSave.data.route"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    label="N°"
                    hide-details
                    v-model="placeSave.data.number"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Complemento"
                    hide-details
                    v-model="placeSave.data.complement"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="CEP"
                    hide-details
                    v-model="placeSave.data.zipcode"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Bairro"
                    hide-details
                    v-model="placeSave.data.district"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Cidade"
                    hide-details
                    v-model="placeSave.data.city"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Estado"
                    hide-details
                    v-model="placeSave.data.state"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-autocomplete
                    label="País"
                    hide-details 
                    v-model="placeSave.data.country_short"
                    @update:modelValue="placeAutosave()"
                    :items="countries"
                ></v-autocomplete>
            </v-col>

            <v-col cols="12">
                <l-map ref="map" :zoom="18" :center="[(placeSave.data.lat||0), (placeSave.data.lng||0)]" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="[(placeSave.data.lat||0), (placeSave.data.lng||0)]" :draggable="true" @dragend="updateLatLng($event)"></l-marker>
                </l-map>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:false, type:[Boolean, Number, String, Object]},
        returnType: {default:'id'}, // id, object
        label: {default:''},
        autoSave: {default:true},
    },

    watch: {
        '$props.modelValue': {async handler() {
            this.placeFind();
        }},
    },

    methods: {
        emitValue() {
            this.$emit('update:modelValue', {...this.placeSave.data});
        },

        async setPlace(place) {
            let id = (typeof this.modelValue=='object')? (this.modelValue.id): this.modelValue;
            
            if (id) {
                this.placeSave.data = {...place, id};
                this.placeSave.submit();
            }
            else {
                this.placeSave.data = place;
            }

            this.placesListShow = false;
            this.emitValue();
        },

        async placeFind() {
            if (this.returnType=='id') {
                if (isNaN(this.modelValue)) return;
                this.placeSave.data = (await this.$axios.get(`/api/places/find/${this.modelValue}`)).data;
            }
            else if (this.returnType=='object') {
                this.placeSave.data = {...(this.modelValue||{})};
            }
            this.mapRecenter();
        },

        placeAutosave() {
            if (this.autoSave) {
                this.placeSave.submit({debounce:3000});
            }
            if (typeof this.modelValue=='object') {
                this.emitValue();
            }
        },

        mapRecenter() {
            setTimeout(() => {
                if (!this.$refs.map.leafletObject) return;
                if (!this.$refs.map.leafletObject.panTo) return;
                this.$refs.map.leafletObject.panTo([
                    (this.placeSave.data.lat || 0),
                    (this.placeSave.data.lng || 0),
                ]);
            }, 100);
        },

        updateLatLng(ev) {
            const coords = {...ev.target._latlng};

            if (this._updateLatLngTimeout) {
                clearTimeout(this._updateLatLngTimeout);
            }

            this._updateLatLngTimeout = setTimeout(() => {
                this.$axios.get('/api/places/place-search', {params:coords}).then(resp => {
                    if (!resp.data[0]) return;
                    this.setPlace(resp.data[0]);
                });
            }, 500);
        },
    },

    async mounted() {
        this.placeFind();
    },

    data() {
        return {
            placesListShow: false,
            places: useAxios({
                method: 'get',
                url: '/api/places/place-search',
                params: {q:''},
                resp: [],
            }),
            placeSave: useAxios({
                method: 'post',
                url: '/api/places/save',
                data: {},
            }),
            countries: [
                {value:"AF", title:"Afeganistão"},
                {value:"ZA", title:"África do Sul"},
                {value:"AL", title:"Albânia"},
                {value:"DE", title:"Alemanha"},
                {value:"AD", title:"Andorra"},
                {value:"AO", title:"Angola"},
                {value:"AI", title:"Anguilla"},
                {value:"AQ", title:"Antártida"},
                {value:"AG", title:"Antígua e Barbuda"},
                {value:"SA", title:"Arábia Saudita"},
                {value:"DZ", title:"Argélia"},
                {value:"AR", title:"Argentina"},
                {value:"AM", title:"Armênia"},
                {value:"AW", title:"Aruba"},
                {value:"AU", title:"Austrália"},
                {value:"AT", title:"Áustria"},
                {value:"AZ", title:"Azerbaijão"},
                {value:"BS", title:"Bahamas"},
                {value:"BH", title:"Bahrein"},
                {value:"BD", title:"Bangladesh"},
                {value:"BB", title:"Barbados"},
                {value:"BY", title:"Belarus"},
                {value:"BE", title:"Bélgica"},
                {value:"BZ", title:"Belize"},
                {value:"BJ", title:"Benin"},
                {value:"BM", title:"Bermudas"},
                {value:"BO", title:"Bolívia"},
                {value:"BA", title:"Bósnia-Herzegóvina"},
                {value:"BW", title:"Botsuana"},
                {value:"BR", title:"Brasil"},
                {value:"BN", title:"Brunei"},
                {value:"BG", title:"Bulgária"},
                {value:"BF", title:"Burkina Fasso"},
                {value:"BI", title:"Burundi"},
                {value:"BT", title:"Butão"},
                {value:"CV", title:"Cabo Verde"},
                {value:"CM", title:"Camarões"},
                {value:"KH", title:"Camboja"},
                {value:"CA", title:"Canadá"},
                {value:"IC", title:"Canárias"},
                {value:"KZ", title:"Cazaquistão"},
                {value:"EA", title:"Ceuta e Melilla"},
                {value:"TD", title:"Chade"},
                {value:"CL", title:"Chile"},
                {value:"CN", title:"China"},
                {value:"CY", title:"Chipre"},
                {value:"SG", title:"Cingapura"},
                {value:"CO", title:"Colômbia"},
                {value:"KM", title:"Comores"},
                {value:"CG", title:"Congo"},
                {value:"KP", title:"Coréia do Norte"},
                {value:"KR", title:"Coréia do Sul"},
                {value:"CI", title:"Costa do Marfim"},
                {value:"CR", title:"Costa Rica"},
                {value:"HR", title:"Croácia"},
                {value:"CU", title:"Cuba"},
                {value:"CW", title:"Curaçao"},
                {value:"DG", title:"Diego Garcia"},
                {value:"DK", title:"Dinamarca"},
                {value:"DJ", title:"Djibuti"},
                {value:"DM", title:"Dominica"},
                {value:"EG", title:"Egito"},
                {value:"SV", title:"El Salvador"},
                {value:"AE", title:"Emirados Árabes Unidos"},
                {value:"EC", title:"Equador"},
                {value:"ER", title:"Eritréia"},
                {value:"SK", title:"Eslováquia"},
                {value:"SI", title:"Eslovênia"},
                {value:"ES", title:"Espanha"},
                {value:"US", title:"Estados Unidos"},
                {value:"EE", title:"Estônia"},
                {value:"ET", title:"Etiópia"},
                {value:"FJ", title:"Fiji"},
                {value:"PH", title:"Filipinas"},
                {value:"FI", title:"Finlândia"},
                {value:"FR", title:"França"},
                {value:"GA", title:"Gabão"},
                {value:"GM", title:"Gâmbia"},
                {value:"GH", title:"Gana"},
                {value:"GE", title:"Geórgia"},
                {value:"GI", title:"Gibraltar"},
                {value:"GB", title:"Grã-Bretanha (Reino Unido, UK)"},
                {value:"GD", title:"Granada"},
                {value:"GR", title:"Grécia"},
                {value:"GL", title:"Groelândia"},
                {value:"GP", title:"Guadalupe"},
                {value:"GU", title:"Guam (Território dos Estados Unidos)"},
                {value:"GT", title:"Guatemala"},
                {value:"GG", title:"Guernsey"},
                {value:"GY", title:"Guiana"},
                {value:"GF", title:"Guiana Francesa"},
                {value:"GN", title:"Guiné"},
                {value:"GQ", title:"Guiné Equatorial"},
                {value:"GW", title:"Guiné-Bissau"},
                {value:"HT", title:"Haiti"},
                {value:"NL", title:"Holanda"},
                {value:"HN", title:"Honduras"},
                {value:"HK", title:"Hong Kong"},
                {value:"HU", title:"Hungria"},
                {value:"YE", title:"Iêmen"},
                {value:"BV", title:"Ilha Bouvet"},
                {value:"AC", title:"Ilha de Ascensão"},
                {value:"CP", title:"Ilha de Clipperton"},
                {value:"IM", title:"Ilha de Man"},
                {value:"CX", title:"Ilha Natal"},
                {value:"PN", title:"Ilha Pitcairn"},
                {value:"RE", title:"Ilha Reunião"},
                {value:"AX", title:"Ilhas Aland"},
                {value:"KY", title:"Ilhas Cayman"},
                {value:"CC", title:"Ilhas Cocos"},
                {value:"CK", title:"Ilhas Cook"},
                {value:"FO", title:"Ilhas Faroes"},
                {value:"GS", title:"Ilhas Geórgia do Sul e Sandwich do Sul"},
                {value:"HM", title:"Ilhas Heard e McDonald (Território da Austrália)"},
                {value:"FK", title:"Ilhas Malvinas"},
                {value:"MP", title:"Ilhas Marianas do Norte"},
                {value:"MH", title:"Ilhas Marshall"},
                {value:"UM", title:"Ilhas Menores dos Estados Unidos"},
                {value:"NF", title:"Ilhas Norfolk"},
                {value:"SB", title:"Ilhas Salomão"},
                {value:"SC", title:"Ilhas Seychelles"},
                {value:"TK", title:"Ilhas Tokelau"},
                {value:"TC", title:"Ilhas Turks e Caicos"},
                {value:"VI", title:"Ilhas Virgens (Estados Unidos)"},
                {value:"VG", title:"Ilhas Virgens (Inglaterra)"},
                {value:"IN", title:"Índia"},
                {value:"ID", title:"Indonésia"},
                {value:"IR", title:"Irã"},
                {value:"IQ", title:"Iraque"},
                {value:"IE", title:"Irlanda"},
                {value:"IS", title:"Islândia"},
                {value:"IL", title:"Israel"},
                {value:"IT", title:"Itália"},
                {value:"JM", title:"Jamaica"},
                {value:"JP", title:"Japão"},
                {value:"JE", title:"Jersey"},
                {value:"JO", title:"Jordânia"},
                {value:"KI", title:"Kiribati"},
                {value:"XK", title:"Kosovo"},
                {value:"KW", title:"Kuait"},
                {value:"LA", title:"Laos"},
                {value:"LS", title:"Lesoto"},
                {value:"LV", title:"Letônia"},
                {value:"LB", title:"Líbano"},
                {value:"LR", title:"Libéria"},
                {value:"LY", title:"Líbia"},
                {value:"LI", title:"Liechtenstein"},
                {value:"LT", title:"Lituânia"},
                {value:"LU", title:"Luxemburgo"},
                {value:"MO", title:"Macau"},
                {value:"MK", title:"Macedônia (República Yugoslava)"},
                {value:"MG", title:"Madagascar"},
                {value:"MY", title:"Malásia"},
                {value:"MW", title:"Malaui"},
                {value:"MV", title:"Maldivas"},
                {value:"ML", title:"Mali"},
                {value:"MT", title:"Malta"},
                {value:"MA", title:"Marrocos"},
                {value:"MQ", title:"Martinica"},
                {value:"MU", title:"Maurício"},
                {value:"MR", title:"Mauritânia"},
                {value:"YT", title:"Mayotte"},
                {value:"MX", title:"México"},
                {value:"FM", title:"Micronésia"},
                {value:"MZ", title:"Moçambique"},
                {value:"MD", title:"Moldova"},
                {value:"MC", title:"Mônaco"},
                {value:"MN", title:"Mongólia"},
                {value:"ME", title:"Montenegro"},
                {value:"MS", title:"Montserrat"},
                {value:"MM", title:"Myanma"},
                {value:"NA", title:"Namíbia"},
                {value:"NR", title:"Nauru"},
                {value:"NP", title:"Nepal"},
                {value:"NI", title:"Nicarágua"},
                {value:"NE", title:"Níger"},
                {value:"NG", title:"Nigéria"},
                {value:"NU", title:"Niue"},
                {value:"NO", title:"Noruega"},
                {value:"NC", title:"Nova Caledônia"},
                {value:"NZ", title:"Nova Zelândia"},
                {value:"OM", title:"Omã"},
                {value:"BQ", title:"Países Baixos Caribenhos"},
                {value:"PW", title:"Palau"},
                {value:"PS", title:"Palestina"},
                {value:"PA", title:"Panamá"},
                {value:"PG", title:"Papua-Nova Guiné"},
                {value:"PK", title:"Paquistão"},
                {value:"PY", title:"Paraguai"},
                {value:"PE", title:"Peru"},
                {value:"PF", title:"Polinésia Francesa"},
                {value:"PL", title:"Polônia"},
                {value:"PR", title:"Porto Rico"},
                {value:"PT", title:"Portugal"},
                {value:"QA", title:"Qatar"},
                {value:"KE", title:"Quênia"},
                {value:"KG", title:"Quirguistão"},
                {value:"CF", title:"República Centro-Africana"},
                {value:"CD", title:"República Democrática do Congo"},
                {value:"DO", title:"República Dominicana"},
                {value:"CZ", title:"República Tcheca"},
                {value:"RO", title:"Romênia"},
                {value:"RW", title:"Ruanda"},
                {value:"RU", title:"Rússia (antiga URSS) - Federação Russa"},
                {value:"EH", title:"Saara Ocidental"},
                {value:"PM", title:"Saint-Pierre e Miquelon"},
                {value:"AS", title:"Samoa Americana"},
                {value:"WS", title:"Samoa Ocidental"},
                {value:"SM", title:"San Marino"},
                {value:"SH", title:"Santa Helena"},
                {value:"LC", title:"Santa Lúcia"},
                {value:"BL", title:"São Bartolomeu"},
                {value:"KN", title:"São Cristóvão e Névis"},
                {value:"MF", title:"São Martim"},
                {value:"SX", title:"São Martinho"},
                {value:"ST", title:"São Tomé e Príncipe"},
                {value:"VC", title:"São Vicente e Granadinas"},
                {value:"SN", title:"Senegal"},
                {value:"SL", title:"Serra Leoa"},
                {value:"RS", title:"Sérvia"},
                {value:"SY", title:"Síria"},
                {value:"SO", title:"Somália"},
                {value:"LK", title:"Sri Lanka"},
                {value:"SZ", title:"Suazilândia"},
                {value:"SD", title:"Sudão"},
                {value:"SS", title:"Sudão do Sul"},
                {value:"SE", title:"Suécia"},
                {value:"CH", title:"Suíça"},
                {value:"SR", title:"Suriname"},
                {value:"SJ", title:"Svalbard"},
                {value:"TJ", title:"Tadjiquistão"},
                {value:"TH", title:"Tailândia"},
                {value:"TW", title:"Taiwan"},
                {value:"TZ", title:"Tanzânia"},
                {value:"IO", title:"Território Britânico do Oceano índico"},
                {value:"TF", title:"Territórios do Sul da França"},
                {value:"TL", title:"Timor-Leste"},
                {value:"TG", title:"Togo"},
                {value:"TO", title:"Tonga"},
                {value:"TT", title:"Trinidad e Tobago"},
                {value:"TA", title:"Tristão da Cunha"},
                {value:"TN", title:"Tunísia"},
                {value:"TM", title:"Turcomenistão"},
                {value:"TR", title:"Turquia"},
                {value:"TV", title:"Tuvalu"},
                {value:"UA", title:"Ucrânia"},
                {value:"UG", title:"Uganda"},
                {value:"UY", title:"Uruguai"},
                {value:"UZ", title:"Uzbequistão"},
                {value:"VU", title:"Vanuatu"},
                {value:"VA", title:"Vaticano"},
                {value:"VE", title:"Venezuela"},
                {value:"VN", title:"Vietnã"},
                {value:"WF", title:"Wallis e Futuna"},
                {value:"ZM", title:"Zâmbia"},
                {value:"ZW", title:"Zimbábue"}
            ],
        };
    },
};
</script>