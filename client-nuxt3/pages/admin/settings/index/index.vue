<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    label="Nome app"
                    :hide-details="true"
                    v-model="sets['app.name']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Timezone"
                    :hide-details="true"
                    v-model="sets['app.timezone']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Idioma"
                    :hide-details="true"
                    v-model="sets['app.locale']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <app-model-file-select
                    label="Selecionar ícone"
                    v-model="sets['app.icon']"
                    return-type="url"
                ></app-model-file-select>
            </v-col>
            
            <v-col cols="12" md="6">
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