<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    label="Tipo de conexão"
                    :hide-details="true"
                    v-model="sets.resp['mail.default']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="8">
                <v-text-field
                    label="Host"
                    :hide-details="true"
                    v-model="sets.resp['mail.mailers.smtp.host']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
                <v-text-field
                    label="Porta"
                    :hide-details="true"
                    v-model="sets.resp['mail.mailers.smtp.port']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field
                    label="Usuário"
                    :hide-details="true"
                    v-model="sets.resp['mail.mailers.smtp.username']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field
                    label="Senha"
                    :hide-details="true"
                    v-model="sets.resp['mail.mailers.smtp.password']"
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