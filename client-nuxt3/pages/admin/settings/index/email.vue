<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-text-field label="Tipo de conexão" :hide-details="true"></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field label="Host" :hide-details="true"></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field label="Port" :hide-details="true"></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field label="Username" :hide-details="true"></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field label="Password" :hide-details="true"></v-text-field>
            </v-col>
        </v-row>
    </div>
</template>