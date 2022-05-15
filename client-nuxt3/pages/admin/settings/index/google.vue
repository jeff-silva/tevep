<template>
    <div>
        <v-row>
            <v-col cols="6">
                <v-text-field label="Google Analytics ID (GA4)" v-model="sets['google.ga4.id']"></v-text-field>
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

    data() {
        return {};
    },

    mounted() {
        useApp().setTitle('Configurações de arquivo');
    },
}
</script>