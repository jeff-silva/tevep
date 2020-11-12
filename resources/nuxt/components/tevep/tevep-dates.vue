<template><div>
    <draggable v-model="compItems" v-bind="{animation:200, handle:'._handle'}" tag="div" class="row no-gutters" @end="onNodeChange()">
        <div class="tevep-dates-each pb-1 pr-1" :class="col" v-for="n in compItems" :key="n.id" v-tooltip="n.title">
            <div class="input-group">
                <div class="input-group-prepend _handle"><div class="input-group-text">
                    <i class="fa fa-fw fa-bars"></i>
                </div></div>
                <input type="text" class="form-control" v-model="n.title" @focus="focus=n" :placeholder="placeholder" @change="onNodeChange(n)">
            </div>
            <div class="tevep-dates-dropdown bg-white shadow-sm" :class="'tevep-dates-dropdown-'+dropdownPosition+' tevep-dates-dropdown-screen-'+screenSide" v-if="dropdown && focus==n">
                <div class="p-1">
                    <div class="mb-2">{{ n.title }}</div>
                    <small class="text-muted font-weight-bold">Data</small>
                    <ui-datepicker v-model="n.date_start" @input="onNodeChange(n)"></ui-datepicker>
                    <small class="p-2">Final: {{ n.date_final|date }}</small>
                </div>
                <button type="button" class="btn btn-primary btn-sm btn-block rounded-0" @click="nodeGoto(n.id)">
                    Acessar filho
                </button>
            </div>
        </div>
    </draggable>
</div></template>

<style>
.tevep-dates-each {position:relative;}
.tevep-dates-dropdown {position:absolute; width:250px; z-index:9;}
.tevep-dates-dropdown-top {bottom:100%; left:0px;}
.tevep-dates-dropdown-right {top:0px; left:100%;}
.tevep-dates-dropdown-bottom {top:100%; left:0px;}
.tevep-dates-dropdown-left {top:0px; right:100%;}
.tevep-dates-dropdown-screen-left {}
.tevep-dates-dropdown-screen-right {left:auto; right:0px;}
.tevep-dates-dropdown-screen-right.tevep-dates-dropdown-left {right:100%;}
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
		dropdownPosition: {default:'bottom'},
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

		toggleDropdownHandle(ev) {
            // this.screenSide = (ev.target.getBoundingClientRect().x > (window.innerWidth/2))? 'right': 'left';
            if (ev.target.closest('.vdatetime')) return;
			this.dropdown = this.$el.contains(document.activeElement);
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

	mounted() {
		['tap', 'click', 'keyup'].forEach((evt) => {
			window.addEventListener(evt, this.toggleDropdownHandle);
		});
	},

	beforeDestroy() {
		['tap', 'click', 'keyup'].forEach((evt) => {
			window.removeEventListener(evt, this.toggleDropdownHandle);
		});
	},
};</script>