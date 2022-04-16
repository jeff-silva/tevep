<template>
    <div>
        <!-- Render -->
        <div v-if="!edit">
            <component :is="props.value.layout.name||{template:'<div><slot></slot></div>'}" v-bind="props.value.layout.bind">
                <div v-for="(s, i) in (props.value.sections||[])" @click="sectionEdit=s._id; tab='edit';">
                    <component :is="s.component.name" v-bind="s.component.bind"></component>
                </div>
            </component>
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

                            <el-collapse v-model="tab" accordion>

                                <!-- Informações básicas -->
                                <el-collapse-item title="Info" name="info">
                                    <ui-field label="Layout">
                                        <select class="form-control" v-model="props.value.layout.name" @change="props.value.layout.bind = props.layouts.filter(l => l.component.name==props.value.layout.name).map(l => l.bind)[0] || {}">
                                            <option :value="false">Nenhum</option>
                                            <option :value="l.component.name" v-for="l in props.layouts">{{ l.name }}</option>
                                        </select>
                                    </ui-field>

                                    <template v-for="l in props.layouts" v-if="props.value.layout.name && props.value.layout.name==l.component.name">
                                        <component :is="l.componentEdit" v-bind.sync="props.value.layout.bind" @update="$log($event)"></component>
                                    </template>
                                </el-collapse-item>


                                <!-- Seções registradas -->
                                <el-collapse-item title="Inserir seção" name="propsSections">
                                    <div class="input-group mb-2" v-for="s in props.sections">
                                        <div class="form-control">{{ s.name }}</div>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary rounded-0" @click="sectionAdd(s).then(resp => sectionEdit=resp._id); tab='edit';">
                                                <i class="fas fa-fw fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </el-collapse-item>
                                
                                
                                <!-- Seções de value -->
                                <el-collapse-item title="Seções" name="valueSections">
                                    <div v-if="props.value.sections.length==0" class="border p-2">
                                        <small class="d-block text-muted text-center">Nenhuma seção inserida.</small>
                                        <a href="javascript:;" @click="tab='propsSections'" class="d-block text-muted text-center">Inserir</a>
                                    </div>
                                    
                                    <draggable v-model="props.value.sections" v-bind="{handle:'.handle', animation:150}" @end="emitValue()">
                                        <div v-for="(s, i) in (props.value.sections||[])" :key="s._id">
                                            <div class="input-group form-control p-0 mb-2">
                                                <div class="input-group-text handle border-0" style="cursor:s-resize;">:::</div>
                                                <input type="text" class="form-control border-0" v-model="s.name">
                                                
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-success rounded-0 border-0" @click="sectionEdit=s._id; tab='edit';">
                                                        <i class="fas fa-fw fa-edit"></i>
                                                    </button>
                                                </div>

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-danger rounded-0 border-0" @click="sectionRemove(s)">
                                                        <i class="fas fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </draggable>
                                </el-collapse-item>
                                
                                
                                <!-- Tab Editar -->
                                <el-collapse-item title="Editar" name="edit" v-if="sectionEdit">
                                    <template v-for="(s, i) in (props.value.sections||[])" v-if="s._id==sectionEdit">
                                        <template v-for="ss in props.sections" v-if="ss.component.name==s.component.name">
                                            <component :is="ss.componentEdit" v-bind.sync="s.component.bind"></component>
                                        </template>
                                    </template>
                                </el-collapse-item>
                            </el-collapse>
                        </div>
                    </div>
    
                    <!-- Edit render -->
                    <div class="flex-grow-1" style="position:relative; height:100vh; overflow:auto;">
                        <ui-content :value="props.value" :edit="false"></ui-content>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    components: { draggable },

    props: {
        value: {type:[Boolean, Number, String, Array, Object]},
        edit: {default:false, type:Boolean},
        sidebarWidth: {default:"300px"},
        layouts: {default:()=>([]), type:Array},
        sections: {default:()=>([]), type:Array},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.props.value = this.validPropsValue(this.props.value||{});
            this.props.layouts = this.getLayouts();
            this.props.sections = this.getSections();
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        let props = JSON.parse(JSON.stringify(this.$props));
        props.value = this.validPropsValue(props.value||{});
        props.layouts = this.getLayouts();
        props.sections = this.getSections();

        return {
            props,
            elements: [],
            modalEditorActive: true,
            sectionEdit: "",
            tab: "info",
        };
    },

    methods: {
        emitValue() {
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
            this.$emit('value', this.props.value);
            this.$forceUpdate();
        },

        getLayouts() {
            let files = require.context('./layouts', true, /info.js$/);
            return files.keys().map(file => files(file).default);
        },

        getSections() {
            let files = require.context('./sections', true, /info.js$/);
            return files.keys().map(file => files(file).default);
        },

        sectionAdd(section) {
            return new Promise((resolve, reject) => {
                section = {
                    _id: ('section-'+Math.round(Math.random()*99999)),
                    name: section.name,
                    component: {
                        name: section.component.name,
                        bind: (section.bind || {}),
                    },
                };

                this.props.value.sections.push(section);
                resolve(section);
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
            value.layout = value.layout || {name:false, bind:{}};
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
    },
}
</script>

<style>
.ui-content-section-active {outline:solid 1px var(--bs-primary);}
</style>