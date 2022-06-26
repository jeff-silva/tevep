<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    label="Nome app"
                    hide-details
                    v-model="sets['app.name']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Timezone"
                    hide-details
                    v-model="sets['app.timezone']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Idioma"
                    hide-details
                    v-model="sets['app.locale']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-select
                    label="Tempo de autenticação"
                    hide-details
                    v-model="sets['jwt.ttl']"
                    :items="[
                        {value:1, title:'1 minuto'},
                        {value:60*24, title:'24 horas'},
                        {value:60*24*7, title:'Uma semana'},
                        {value:60*24*15, title:'15 dias'},
                        {value:60*24*30, title:'1 mês'},
                        {value:60*24*30*6, title:'6 meses'},
                        {value:60*24*30*12, title:'1 ano'},
                    ]"
                ></v-select>
            </v-col>
            
            <v-col cols="12">
                <app-model-file-select
                    label="Selecionar ícone"
                    v-model="sets['app.icon']"
                    return-type="url"
                ></app-model-file-select>
            </v-col>
            
            <v-col cols="12">
                <app-model-file-select
                    label="Selecionar logo"
                    v-model="sets['app.logo']"
                    return-type="url"
                ></app-model-file-select>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: {
        settings: Object,
    },

    computed: {
        sets() {
            return this.settings;
        },
    },

    mounted() {
        useApp().setTitle('Configurações principais');
    },
};
</script>