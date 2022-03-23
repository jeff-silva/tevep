<template>
    <div class="tevep-edit-draggable d-flex" :class="{'flex-column w-100':(layout=='vertical')}">
        <draggable v-model="props.value" handle=".handle" :class="{'d-flex':(layout=='horizontal')}">
            <div v-for="v in props.value" class="p-1" :class="{'flex-grow-1':(layout=='horizontal')}" :style="`${layout=='horizontal'? 'max-width:300px;': ''}`">
                <div>
                    <div class="input-group input-group-sm">
                        <div class="input-group-text handle">
                            <i class="fas fa-fw fa-bars"></i>
                        </div>
                        <slot :item="v"></slot>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-light btn-sm rounded-0" @click="v.modal=true">
                                <i class="fas fa-fw fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <ui-modal v-model="v.modal">
                        <template #header>Alterar dados</template>
                        <template #body>
                            <ui-field label="Valor">
                                <slot :item="v"></slot>
                            </ui-field>
                        </template>
                        <template #footer>
                            <button type="button" class="btn btn-danger" @click="remove(v)">
                                <i class="fas fa-fw fa-times"></i> Remover
                            </button>

                            <button type="button" class="btn btn-success" @click="tevepCreate(v)">
                                <i class="fas fa-fw fa-plus"></i> Criar evento
                            </button>

                            <button type="button" class="btn btn-light" @click="v.modal=false">
                                Fechar
                            </button>
                        </template>
                    </ui-modal>
                </div>
            </div>
        </draggable>
        
        <div class="p-1" v-if="props.value.length<max">
            <button type="button" class="btn btn-light btn-sm w-100 rounded-0" @click="add()">
                <i class="fas fa-fw fa-plus"></i>
            </button>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    components: {
        draggable,
    },

    props: {
        value: {default:()=>([]), type:Array},
        layout: {default: "horizontal"},
        max: {default: 7},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            // tevep: this.$store.state.tevep.edit,
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        uuid() {
            return ([1e7] + -1e3 + -4e3 + -8e3).replace(/[018]/g, c => (c ^ (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4))) ).toString(16));
        },

        add() {
            this.props.value.push({
                id: this.uuid(),
                tevep_id: false,
                modal: false,
            });
        },

        remove(item) {
            let index = this.props.value.indexOf(item);
            this.props.value.splice(index, 1);
        },

        tevepCreate(item) {

            // chamada ajax para criar tevep
            let tevep = {
                name: (item.name || item.date_start),
                parent_id: this.$store.state.tevep.edit.id,
            };

            this.$axios.post('/api/teveps/save', tevep).then(resp => {
                item.tevep_id = resp.data.id;
                item.modal = false;
                // TODO: setar date_start e date_final

                this.$axios.post('/api/teveps/save', this.$store.state.tevep.edit).then(resp2 => {
                    this.$router.push(`/admin/teveps/${resp.data.id}`);
                    this.$store.state.tevep.edit = resp2.data;
                });
            });
        },
    },
}
</script>

<style>
.tevep-edit-draggable .handle {cursor:move;}

.tevep-edit-draggable .el-date-editor--datetime {
    height: 28px;
}

.tevep-edit-draggable .el-date-editor--datetime .el-input__icon {
    line-height: 28px;
}

.tevep-edit-draggable .el-input__inner {height: 100%;}
</style>