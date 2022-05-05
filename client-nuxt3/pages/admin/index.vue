<template>
    <div>
        <nuxt-layout name="admin">
            Olá admin

            <template #actions>
                <v-btn value="">
                    <span>Salvar</span>
                    <v-icon>mdi-content-save</v-icon>
                </v-btn>

                <v-btn value="">
                    <span>Cancelar</span>
                    <v-icon>mdi-close-thick</v-icon>
                </v-btn>
            </template>
        </nuxt-layout>
    </div>
</template>