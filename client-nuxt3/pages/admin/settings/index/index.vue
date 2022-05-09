<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    label="Nome app"
                    :hide-details="true"
                    v-model="sets.resp['app.name']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Timezone"
                    :hide-details="true"
                    v-model="sets.resp['app.timezone']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Idioma"
                    :hide-details="true"
                    v-model="sets.resp['app.locale']"
                ></v-text-field>
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
};
</script>