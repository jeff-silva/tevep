<template>
    <div>
        <!-- Render -->
        <div v-if="!edit">
            Render
        </div>
        
        <!-- Edit -->
        <div v-if="edit">
            <button type="button" class="btn btn-primary" @click="modalEditorActive=true">
                Abrir editor
            </button>
            
            <transition enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
                <div class="d-flex" style="position:fixed; top:0; left:0; width:100vw; height:100vh; background:#fff; z-index:9; animation-duration:200ms;" v-if="modalEditorActive">
                    <div class="bg-light border-end" :style="`min-width:${sidebarWidth}; max-width:${sidebarWidth}; height:100vh; overflow:auto;`">
                        <div class="bg-primary p-1 text-end text-white">
                            <a href="javascript:;" class="btn btn-sm text-white" @click="modalEditorActive=false; emitValue();">
                                <i class="fas fa-fw fa-times"></i>
                            </a>
                        </div>

                        <div class="p-2">
                            <el-tabs v-model="tab">
    
                                <!-- Tab Elementos -->
                                <el-tab-pane label="Elementos" name="elements">
                                    <div class="input-group mb-2" v-for="e in elements">
                                        <div class="form-control">{{ e.label }}</div>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary rounded-0" @click="sectionAdd(e).then(resp => sectionEdit=resp._id); tab='edit';">
                                                <i class="fas fa-fw fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </el-tab-pane>
    
                                <!-- Tab Seções -->
                                <el-tab-pane label="Seções" name="sections">
                                    <draggable v-model="props.value.sections" v-bind="{handle:'.handle', animation:150}" @end="emitValue()">
                                        <div v-for="(s, i) in (props.value.sections||[])" :key="s._id" @click="sectionEdit=s._id">
                                            <div class="input-group form-control p-0 mb-2">
                                                <div class="input-group-text handle border-0" style="cursor:s-resize;">:::</div>
                                                <input type="text" class="form-control border-0" v-model="s.label">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-danger rounded-0 border-0" @click="sectionRemove(s)">
                                                        <i class="fas fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </draggable>
                                </el-tab-pane>
                                
                                <!-- Tab Editar -->
                                <el-tab-pane label="Editar" name="edit" v-if="sectionEdit">
                                    <div v-for="(s, i) in (props.value.sections||[])" :key="s._id" v-if="s._id==sectionEdit">
                                        <component :is="getComponent(s).edit" v-bind.sync="s.bind"></component>
                                    </div>
                                </el-tab-pane>
                            </el-tabs>
                        </div>
                    </div>
    
                    <div class="flex-grow-1" style="position:relative; height:100vh; overflow:auto;">
                        <div v-for="(s, i) in (props.value.sections||[])" @click="sectionEdit=s._id; tab='edit';">
                            <component :is="getComponent(s).component" v-bind="s.bind"></component>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    props: {
        value: {type:[Boolean, Number, String, Array, Object]},
        edit: {default:false, type:Boolean},
        sidebarWidth: {default:"300px"},
    },

    components: { draggable },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.$el.contains(document.activeElement)) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.props.value = this.validPropsValue(this.props.value||{});
        }},
    },

    data() {
        let props = JSON.parse(JSON.stringify(this.$props));
        props.value = this.validPropsValue(props.value||{});

        let elements = this.getElements();

        return {
            props,
            elements,
            modalEditorActive: false,
            sectionEdit: "",
            tab: "elements",
        };
    },

    methods: {
        emitValue() {
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
            this.$emit('value', this.props.value);
            this.$forceUpdate();
        },

        sectionAdd(elem) {
            return new Promise((resolve, reject) => {
                elem = JSON.parse(JSON.stringify(elem));
                elem = {_id: ('section-'+Math.round(Math.random()*99999)), ...elem};
                delete elem.component;
                delete elem.edit;

                this.props.value = this.props.value || {};
                this.props.value.sections = this.props.value.sections||[];
                this.props.value.sections.push(elem);
                this.emitValue();
                resolve(elem);
            });
        },

        sectionRemove(sect) {
            let index = this.props.value.sections.indexOf(sect);
            this.props.value.sections.splice(index, 1);
            this.emitValue();
        },

        getComponent(sect) {
            for(let i in this.elements) {
                let elem = this.elements[i];
                if (sect.name==elem.name) {
                    return elem;
                }
            }
            
            return {};
        },

        validPropsValue(value) {
            if (!typeof value=="object") value = {};
            value.title = value.title || "";
            value.sections = value.sections||[];
            return value;
        },

        validateValue() {
            this.props.value = this.props.value || {};

            if (typeof this.props.value=="string") {
                this.props.value = JSON.parse(this.props.value);
            }

            if (typeof this.props.value!="object" || (typeof this.props.value=="object" && !Array.isArray(this.props.value))) {
                this.props.value = {};
            }

            this.props.value.title = this.props.value.title || "";

            if (!this.props.value.sections) {
                this.props.value.sections = [];
            }

            this.props.value.sections = this.props.value.sections.map(section => {
                section._id = section._id || ('section-'+Math.round(Math.random()*99999));
                return section;
            });

            this.emitValue();
        },

        handlerDrawerSectionClick(ev) {
            this.emitValue();
            if (!ev.target.classList.contains('el-drawer__container')) return;
            this.sectionEdit = false;
        },

        getElements() {
            let files = require.context('./', true, /(index|edit)\.vue$/);
            return files.keys().map(key => {
                if (! /edit\.vue$/.test(key)) return null;
                let edit = files(key).default;
                
                let bind = {};
                for(let i in edit.props) {
                    let _value = edit.props[i].default || "";
                    if (typeof _value=="function") { _value = _value(); }
                    bind[i] = _value;
                }

                return {
                    label: edit.name.replace('UiContent', '').replace(/Edit$/, '').replace(/([a-z0-9])([A-Z])/g, '$1 $2'),
                    bind,
                    component: files(key.replace('edit.vue', 'index.vue')).default,
                    edit,
                };
            }).filter(item => !!item);
        },
    },
}
</script>

<style>
.ui-content-section-active {outline:solid 1px var(--bs-primary);}
</style>