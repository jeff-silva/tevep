<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <div ref="swagger"></div>
            </v-container>
        </nuxt-layout>
    </div>
</template>

<script>
import { SwaggerUIBundle, SwaggerUIStandalonePreset } from 'swagger-ui-dist';
import 'swagger-ui-dist/swagger-ui.css';

export default {
    methods: {
        async swaggerInit() {
            const { data } = await this.$axios.get('/api/app/swagger');
            new SwaggerUIBundle({
                domNode: this.$refs.swagger,
                deepLinking: true,
                presets: [SwaggerUIBundle.presets.apis, SwaggerUIStandalonePreset],
                layout: "StandaloneLayout",
                spec: data,
            });
      },
    },

    async mounted() {
        await this.swaggerInit();
    },
};
</script>