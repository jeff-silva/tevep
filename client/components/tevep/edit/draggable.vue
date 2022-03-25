<template>
    <div>
        <!-- Modal -->
        <template v-for="(v, i) in props.value" v-if="v.meta_ref==$route.query.meta_ref">
            <ui-form tag="div" method="post" action="/api/teveps/save" :value="v" #default="form" @success="v={...$event, meta:null}; $emit('input', props.value);">
                <ui-modal :value="true" width="500px" @close="$router.push({query:{}})">
                    <template #header>Alterar dados</template>
                    <template #body>
                        <ui-field label="Nome" :error="form.errorFields.name">
                            <input type="text" class="form-control" v-model="form.value.name">
                        </ui-field>
    
                        <ui-field label="Data início" :error="form.errorFields.date_start">
                            <el-date-picker
                                class="w-100"
                                v-model="form.value.date_start"
                                type="datetime"
                                placeholder="Selecionar data/hora"
                                value-format="yyyy-MM-dd HH:mm:ss"
                                format="dd/MM/yyyy - HH:mm:ss"
                                @input="updateNeighDate(v.date_start, v, -1, 'date_final')"
                            ></el-date-picker>
                        </ui-field>
    
                        <ui-field label="Data fim" :error="form.errorFields.date_final">
                            <el-date-picker
                                class="w-100"
                                v-model="form.value.date_final"
                                type="datetime"
                                placeholder="Selecionar data/hora"
                                value-format="yyyy-MM-dd HH:mm:ss"
                                format="dd/MM/yyyy - HH:mm:ss"
                                @input="updateNeighDate(v.date_final, v, +1, 'date_start')"
                            ></el-date-picker>
                        </ui-field>
    
                        <pre>form.value: {{ form.value }}</pre>
                    </template>
                    <template #footer>
                        <nuxt-link :to="{query:{}}" class="btn btn-light me-auto">
                            Cancelar
                        </nuxt-link>

                        <button type="button" class="btn btn-danger" @click="remove(v)">
                            <i class="fas fa-fw fa-times"></i> Deletar
                        </button>
    
                        <nuxt-link :to="`/admin/teveps/${v.id}`" class="btn btn-primary" v-if="v.id">
                            Acessar Tevep
                        </nuxt-link>
    
                        <button type="button" class="btn btn-success" @click="form.submit();" v-if="v.parent_id" v-loading="form.loading">
                            <i class="fas fa-fw fa-save"></i> {{ v.id? 'Salvar': 'Criar Tevep filho' }}
                        </button>
                    </template>
                </ui-modal>
            </ui-form>
        </template>


        <!-- Draggable -->
        <div class="tevep-edit-draggable d-flex" :class="{'flex-column w-100':(layout=='vertical')}">
            <draggable v-model="props.value" handle=".handle" :class="{'d-flex':(layout=='horizontal')}" @start="dragStart" @end="dragEnd">
                <div v-for="v in props.value" class="p-1"
                    :class="{'flex-grow-1':(layout=='horizontal'), 'tevep-edit-draggable-item-selected':($route.query.meta_ref==v.meta_ref)}"
                    :style="`${layout=='horizontal'? 'max-width:300px;': ''}`"
                >
                    <div>
                        <div class="input-group input-group-sm tevep-edit-draggable-input-group">
                            <div class="input-group-text border-end-0 handle">
                                <i class="fas fa-fw fa-bars"></i>
                            </div>
                            <slot :item="v" :updateNeighDate="updateNeighDate"></slot>
                            <div class="input-group-btn">
                                <nuxt-link :to="{query:{meta_ref:v.meta_ref}}" class="btn btn-light btn-sm rounded-0">
                                    <i class="fas fa-fw fa-ellipsis-v"></i>
                                </nuxt-link>
                            </div>
                        </div>
                    </div>
                </div>
            </draggable>
            
            <div class="p-1" v-if="props.value.length<max">
                <button type="button" class="btn btn-light btn-sm w-100 rounded-0" @click="add()">
                    <i class="fas fa-fw fa-plus"></i>
                </button>
            </div>
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
            errorFields: {},
        };
    },

    methods: {
        uuid() {
            return ([1e7] + -1e3 + -4e3 + -8e3).replace(/[018]/g, c => (c ^ (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4))) ).toString(16));
        },

        add() {
            this.props.value.push({
                id: '',
                name: `${this.$store.state.tevep.edit.name||''} #${this.props.value.length+1}`,
                date_start: '',
                date_final: '',
                meta_ref: this.uuid(),
                parent_id: (this.$store.state.tevep.edit.id||false),
            });
        },

        remove(item) {
            if (item.id) {
                return this.$confirm('Deseja deletar este Tevep e seus respectivos filhos?').then(resp => {
                    this.$axios.post('/api/teveps/delete', {id:item.id}).then(resp => {
                        let index = this.props.value.indexOf(item);
                        this.props.value.splice(index, 1);
                    });
                });
            }

            let index = this.props.value.indexOf(item);
            this.props.value.splice(index, 1);
        },

        tevepLoad(item) {
            this.$axios.post(`/api/teveps/${item.tevep_id}`, tevep).then(resp => {
                // 
            });
        },

        updateNeighDate(value, item, index, attr) {
            let currentIndex = this.props.value.indexOf(item);
            let neigh = this.props.value[ currentIndex+index ] || false;
            if (!neigh) return;
            if (!neigh[attr]) return;
            neigh[attr] = value;
        },

        dragStart(ev) {
            this.__fakeDates = [];
            this.props.value.forEach(item => {
                this.__fakeDates.push({
                    date_start: (item.date_start||''),
                    date_final: (item.date_final||''),
                });
            });
        },

        dragEnd(ev) {
            if (! typeof this.__fakeDates=="object") return;
            this.props.value.forEach((item, index) => {
                let fakeDate = this.__fakeDates[index] || false;
                if (!fakeDate) return;
                item.date_start = fakeDate.date_start;
                item.date_final = fakeDate.date_final;
            });
        },
    },
}
</script>

<style>
.tevep-edit-draggable .handle {cursor:move;}

.tevep-edit-draggable-input-group .el-date-editor--datetime {
    height: 28px;
}

.tevep-edit-draggable-input-group .el-date-editor--datetime .el-input__icon {
    line-height: 28px;
}

.tevep-edit-draggable-input-group .el-input__inner {height: 100%;}

.tevep-edit-draggable-item-selected .tevep-edit-draggable-input-group > .input-group-text,
.tevep-edit-draggable-item-selected .tevep-edit-draggable-input-group > .form-control,
.tevep-edit-draggable-item-selected .tevep-edit-draggable-input-group > .input-group-btn > .btn {
    border-color: var(--bs-primary);
}

.tevep-edit-draggable-item-selected .tevep-edit-draggable-input-group > .input-group-text,
.tevep-edit-draggable-item-selected .tevep-edit-draggable-input-group > .input-group-btn > .btn {
    background-color: var(--bs-primary);
    color: #fff;
}
</style>