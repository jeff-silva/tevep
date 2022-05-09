<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-select label="Storage type" :hide-details="true" :items="itemsStorageType"></v-select>
            </v-col>

            <v-col cols="12">
                <v-select label="Tamanho máximo de arquivo" :hide-details="true" :items="itemsMaxFilesize"></v-select>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
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