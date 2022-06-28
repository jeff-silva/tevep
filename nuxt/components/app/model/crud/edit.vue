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
                        Drawer
                    </div>
                </v-card-content>
            </v-card>
        </v-navigation-drawer>

        <!-- Main -->
        <v-container class="pa-0" :fluid="editFluid">
            <div style="height:3px;">
                <v-progress-linear
                    v-if="search.loading"
                    indeterminate
                />
            </div>
            <slot name="edit-card" v-bind="slotBind()">
                <v-card elevation="0">
                    <v-card-text>
                        <slot name="edit-fields" v-bind="slotBind()"></slot>
                    </v-card-text>
                </v-card>
            </slot>
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
            }),
        };
    },
    methods: {
        // 
    },
};
</script>