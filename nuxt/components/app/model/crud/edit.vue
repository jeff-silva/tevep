<template>
    <form>
        <!-- Footer actions -->
        <app-actions>
            Ações rodapé
        </app-actions>

        <!-- Drawer actions -->
        <v-navigation-drawer
            v-model="drawer"
            location="right"
            width="300"
        >
            <v-card :title="app.title" :elevation="0">
                <v-divider />
                <v-card-content>
                    <div class="d-flex flex-column" style="gap:15px;">
                        <v-btn color="primary">Salvar</v-btn>
                        <v-btn :to="`/admin/${namespace}`">Voltar</v-btn>
                    </div>
                </v-card-content>
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
            <v-sheet elevation="5" class="py-5 px-3">
                <slot name="edit-form" v-bind="slotBind({ edit: edit.data })"></slot>
                <!-- <pre>{{ edit }}</pre> -->
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
            edit: useAxios({
                method: "post",
                url: `/api/${this.namespace}/save`,
                data: {},
                onSubmited: (resp) => {
                    this.edit.data = resp.data;
                    this.app.setTitle(`Editar ${this.singular}: ${this.edit.data.name}`);
                    this.alert({type:'success', text:`${this.singular} salvo`});
                },
                onMounted: (req) => {
                    if (this.$route.query.clone) {
                        return this.$axios.get(`/api/${this.namespace}/find/${this.$route.query.clone}`).then(resp => {
                            resp.data.id = 0;
                            for(let i in resp.data) req.data[i] = resp.data[i];
                            this.$router.push({ query: {edit:'new'} });
                        });
                    }

                    this.$axios.get(`/api/${this.namespace}/find/${this.$route.query.edit}`).then(resp => {
                        for(let i in resp.data) req.data[i] = resp.data[i];
                    });
                },
            }),
        };
    },
    methods: {
        init() {
            if (this.$route.query.clone) {
                return this.$axios.get(`/api/${this.namespace}/find/${this.$route.query.clone}`).then(resp => {
                    resp.data.id = 0;
                    this.edit.data = resp.data;
                    this.$router.push({ query: {edit:'new'} });
                });
            }

            this.$axios.get(`/api/${this.namespace}/find/${this.$route.query.edit}`).then(resp => {
                this.edit.data = resp.data;
            });
        },
    },
    mounted() {
        this.init();
    },
};
</script>