<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud namespace="pages-elements">
                <template #search-table-header>
                    <th>Página</th>
                    <th>Tipo</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">/{{ item.slug }}</div>
                    </td>
                    <td>{{ item.type }}</td>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="8">
                            <v-text-field label="Nome" v-model="crud.edit.name" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="4">
                            <v-text-field label="Tipo" v-model="crud.edit.type" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <app-code label="Componente" v-model="crud.edit.comp" language="javascript" @update:modelValue="$log"></app-code>
                            <pre>crud.edit.comp: {{ crud.edit.comp }}</pre>
                        </v-col>
                        
                        <v-col cols="12">
                            <app-code label="Editor" v-model="crud.edit.edit" language="javascript" @update:modelValue="$log"></app-code>
                            <pre>crud.edit.edit: {{ crud.edit.edit }}</pre>
                        </v-col>
                    </v-row>

                    <pre>{{ crud }}</pre>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>