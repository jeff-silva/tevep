<template>
    <form @submit.prevent="edit.submit()">
        <!-- Footer actions -->
        <app-actions>
            <v-btn icon="mdi-close" :to="`/admin/${namespace}`"></v-btn>
            <v-btn icon="mdi-content-save"></v-btn>
        </app-actions>

        <!-- Drawer actions -->
        <v-navigation-drawer
            v-model="drawer"
            location="right"
            width="300"
        >
            <v-card :title="app.title" :elevation="0">
                <v-divider />
                <v-card-text>
                    <div class="d-flex flex-column" style="gap:15px;">
                        <v-btn color="primary" type="submit">Salvar</v-btn>
                        <v-btn :to="`/admin/${namespace}`">Voltar</v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-navigation-drawer>

        <!-- Main -->
        <v-container class="pa-0" :fluid="fluid">
            <div style="height:3px;">
                <v-progress-linear
                    v-if="edit.loading"
                    indeterminate
                />
            </div>
            <v-alert v-if="edit.status==200" type="success" rounded="0">Dados de {{ plural }} salvos</v-alert>
            <v-alert v-if="edit.err.message" type="error" rounded="0">{{ edit.err.message }}</v-alert>
            <v-sheet elevation="5" class="py-5 px-3">
                <slot name="edit-form" v-bind="slotBind({ edit: edit.data })"></slot>
            </v-sheet>
        </v-container>
    </form>
</template>

<script>
import base from './base.vue';

export default {
    extends: base,
    props: {
        // 
    },
    data() {
        return {
            valid: useValidation(),
            edit: useAxios({
                method: "post",
                url: `/api/${this.namespace}/save`,
                data: {},
                onSubmited: (resp) => {
                    this.edit.data = resp.data;
                    this.app.setTitle(`Editar ${this.singular}: ${this.edit.data.name}`);
                    this.alert({type:'success', text:`${this.singular} salvo`});
                },
                onSuccess: (resp) => {
                    this.$emit('success', resp);
                },
                onError: (resp) => {
                    this.$emit('error', resp);
                },
                onResponse: (resp) => {
                    this.$emit('response', resp);
                },
            }),
        };
    },
    methods: {
        slotBind(merge={}) {
            return {
                ...merge,
                ...this.$props,
                edit: this.edit.data,
                editFill: this.editFill,
                valid: this.valid,
            };
        },

        init() {
            if (this.$route.query.clone) {
                return this.$axios.get(`/api/${this.namespace}/find/${this.$route.query.clone}`).then(resp => {
                    resp.data.id = 0;
                    this.edit.fillData(resp.data);
                    this.$router.push({ query: {edit:'new'} });
                });
            }

            this.$axios.get(`/api/${this.namespace}/find/${this.$route.query.edit}`).then(resp => {
                this.edit.fillData(resp.data);
            });
        },

        editFill(data) {
            // console.log('editFill', data);
            this.edit.data = data;
        },
    },
    mounted() {
        this.init();
    },
};
</script>