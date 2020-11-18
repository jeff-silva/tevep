<template><div>
    <draggable v-model="compItems" v-bind="{animation:200, handle:'._handle'}" tag="div" class="row no-gutters" @end="onNodeChange()">
        <div class="tevep-dates-each pb-1 pr-1" :class="col" v-for="n in compItems" :key="n.id">
            <div class="input-group">
                <div class="input-group-prepend _handle"><div class="input-group-text">
                    <i class="fa fa-fw fa-bars"></i>
                </div></div>
                <div class="form-control" @click="focus=n" style="white-space:pre; overflow:hidden; cursor:pointer;">{{ n.title||placeholder }}</div>
            </div>

            <!-- Modal -->
            <ui-modal v-model="focus">
                <template #body>
                    <div class="form-group">
                        <label>{{ placeholder }}</label>
                        <input type="text" class="form-control" v-model="focus.title" @change="onNodeChange(focus)" autocomplete="chrome-off">
                    </div>

                    <div class="form-group">
                        <label>Data de início</label>
                        <ui-datepicker v-model="focus.date_start" @input="onNodeChange(focus)"></ui-datepicker>
                    </div>
                </template>

                <template #footer>
                    <button type="button" class="btn btn-primary float-left" @click="nodeGoto(focus.id); focus=false;">
                        Acessar filho
                    </button>

                    <button type="button" class="btn" @click="focus=false">
                        Ok
                    </button>
                </template>
            </ui-modal>
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
        nodeGoto: Function,
        getNodes: Function,
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
            let nodes = this.getNodes({type:'time'});
            nodes.forEach((n, index) => {
                if (n.id==node.id) {
                    node.date_final = (nodes[index+1]? nodes[index+1].date_start: false);

                    if (nodes[index-1]) {
                        this.onNodeChange(nodes[index-1]);
                    }
                }
            });
            
            this.$emit('input', this.props.value);
		},

        emit() {
            this.$emit('input', this.props.value);
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