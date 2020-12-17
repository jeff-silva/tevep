<template><div>
    <draggable v-model="compItems" v-bind="{animation:200, handle:'._handle'}" tag="div" class="row no-gutters" @end="onNodeChange()">
        <div class="tevep-dates-each pb-1 pr-1" :class="col" v-for="n in compItems" :key="n.id" v-tooltip="titleResume(n)">
            <div class="input-group">
                <div class="input-group-prepend _handle"><div class="input-group-text">
                    <i class="fa fa-fw fa-bars"></i>
                </div></div>
                <div class="form-control" @click="focus=n" style="white-space:pre; overflow:hidden; cursor:pointer;">{{ n.title||placeholder }}</div>
            </div>

            <!-- Modal -->
            <ui-modal v-model="focus">
                <template #header>{{ placeholder }}</template>

                <template #body>
                    <div class="row">
                        <div class="col-12 form-group">
                            <label>{{ placeholder }}</label>
                            <input type="text" class="form-control" v-model="focus.title" @change="onNodeChange(focus)" autocomplete="chrome-off">
                        </div>

                        <div class="col-6 form-group">
                            <label>Data de início</label>
                            <ui-datepicker v-model="focus.date_start" @input="onNodeChange(focus)"></ui-datepicker>
                        </div>

                        <div class="col-6 form-group">
                            <label>Data de fim</label>
                            <ui-datepicker v-model="focus.date_final" @input="onNodeChange(focus)"></ui-datepicker>
                        </div>
                    </div>
                </template>

                <template #footer>
                    <button type="button" class="btn btn-primary float-left" @click="nodeGoto(focus.id); focus=false;">
                        Acessar filho
                    </button>

                    <button type="button" class="btn text-danger" @click="focus=false; nodeRemove(n);">
                        <i class="fas fa-times"></i> Remover
                    </button>

                    <button type="button" class="btn" @click="focus=false">
                        Ok
                    </button>
                </template>
            </ui-modal>
        </div>

        <div :class="props.col" v-if="compItems.length<=6">
            <button type="button" class="btn btn-block bg-gray-200" style="padding:5px 5px;" @click="nodeAddBrother()">
                <i class="fas fa-plus"></i> &nbsp; Adicionar {{ placeholder }}
            </button>
        </div>
    </draggable>
</div></template>

<style>
.tevep-dates-each {position:relative;}
</style>

<script>
import draggable from 'vuedraggable';

export default {
    components: {
		draggable,
	},
    
	props: {
		value: {default:()=>([])},
		col: {default:'col-12'},
		type: {default:''},
		placeholder: {default:''},
        nodeId: {default:false},
		node: {default:()=>({})},
		nodeParent: {default:()=>({})},
		nodeChangeDate: Function,
        nodeGoto: Function,
        getNode: Function,
        getNodes: Function,
        nodeAdd: Function,
        nodeRemove: Function,
	},

	watch: {
		$props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    computed: {
        compItems: {
            set(value) {
                value.forEach((item, order) => {
                    for(var i in this.props.value) {
                        var v = this.props.value[i];
                        if (item.id==v.id) {
                            v.order = order;
                            continue;
                        }
                    }
                });

                this.$emit('input', this.props.value);
            },
            
            get() {
                let nodes = this.props.value.filter((item) => {
                    return item.type==this.type;
                });

                return nodes.sort((a, b) => {
                    if ( a.order < b.order ) { return -1; }
                    if ( a.order > b.order ) { return 1; }
                    return 0;
                });
            },
        },
    },

	methods: {
		onNodeChange(node) {
            
            this.nodeChangeDate(node);

            // let nodes = this.getNodes({type:'time'});
            // nodes.forEach((n, index) => {
            //     if (n.id==node.id) {
            //         node.date_final = (nodes[index+1]? nodes[index+1].date_start: false);

            //         if (nodes[index-1]) {
            //             this.onNodeChange(nodes[index-1]);
            //         }
            //     }
            // });
            
            // this.$emit('input', this.props.value);
		},

        emit() {
            this.$emit('input', this.props.value);
        },

        nodeAddBrother() {
            let brothers = this.getNodes({type:this.type});
            if (brothers.length==7) { this.$swalError('Máximo de 7 itens'); return; }
            this.nodeAdd({type:this.type, parent:this.$props.node.id}, false);
            this.$emit('input', this.props.value);
        },

        titleResume(node) {
            let formatDate = this.$options.filters.date;
            let lines = [];
            if (node.date_start) lines.push(`Início:&ensp;${formatDate(node.date_start)}`);
            if (node.date_final) lines.push(`Fim: &ensp;&ensp;${formatDate(node.date_final)}`);

            if (lines.length==0) return false;
            return '<div class="text-left">'+ lines.join('<br>') +'</div>';
        },
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
			focus: false,
            dropdown: false,
            screenSide: 'left',
		};
	},
};</script>