<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-select
                    label="Storage type"
                    :hide-details="true"
                    :items="itemsStorageType"
                    v-model="sets.resp['app_models_files.storage_type']"
                ></v-select>
            </v-col>

            <v-col cols="12">
                <v-select
                    label="Tamanho máximo de arquivo"
                    :hide-details="true"
                    :items="itemsMaxFilesize"
                    v-model="sets.resp['app_models_files.max_upload_size']"
                ></v-select>
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
        return {
            itemsStorageType: [
                {value:'database', text:'Banco de dados'},
                {value:'file', text:'Arquivo'},
            ],
            itemsMaxFilesize: [
                {value:(1*1000000), text:'1mb'},
                {value:(5*1000000), text:'5mb'},
                {value:(10*1000000), text:'10mb'},
            ],
        };
    },
}
</script>