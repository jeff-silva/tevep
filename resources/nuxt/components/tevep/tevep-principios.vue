<template><div>
	<div class="row no-gutters mb-3">
		<div class="col-12">
			<tevep-dates v-model="props.nodeChildren"
                col="col"
                type="time"
                dropdown-position="bottom"
                placeholder="Tempo"
                v-bind="props"
            ></tevep-dates>
		</div>
	</div>

	<div class="row no-gutters align-items-center">
		<div class="col-4">
            <tevep-dates v-model="props.nodeChildren"
                col="col-12"
                type="user"
                dropdown-position="right"
                placeholder="Piloto (e-mail)"
                v-bind="props"
            ></tevep-dates>
		</div>

		<div class="col-4 p-2">
			<div class="input-group">
				<div class="input-group-prepend"><div class="input-group-text" style="width:70px;">
					Nome
				</div></div>
				<input type="text" class="form-control" v-model="node.title">
				<div class="input-group-append"><div class="input-group-btn" v-if="nodeParent.id">
					<nuxt-link :to="{query:{node:nodeParent.id, tab:$route.query.tab}}" class="btn btn-primary">
                        <i class="fa fa-level-up"></i>
                    </nuxt-link>
				</div></div>
			</div>
            <div class="input-group">
                <div class="input-group-prepend"><div class="input-group-text" style="width:70px;">
                    Início
                </div></div>
                <ui-datepicker v-model="props.node.date_start" class="form-control p-0 border-0"></ui-datepicker>
            </div>
            <div class="input-group">
                <div class="input-group-prepend"><div class="input-group-text" style="width:70px;">
                    Fim
                </div></div>
                <ui-datepicker v-model="props.node.date_final" class="form-control p-0 border-0"></ui-datepicker>
            </div>
		</div>

		<div class="col-4">
			<tevep-dates v-model="props.nodeChildren"
                col="col-12"
                type="target"
                dropdown-position="left"
                placeholder="Pessoas"
                v-bind="props"
            ></tevep-dates>
		</div>
	</div>

	<div class="row no-gutters mt-3">
		<tevep-dates v-model="props.nodeChildren"
            col="col"
            type="space"
            dropdown-position="top"
            placeholder="Espaço"
            v-bind="props"
        ></tevep-dates>
	</div>
</div></template>


<script>
import draggable from 'vuedraggable';

export default {
    components: {
		draggable,
	},
    
	props: {
		value: {default:()=>([])},
		node: {default:()=>({})},
		nodeChildren: {default:()=>([])},
		nodeParent: {default:()=>({})},
        nodeGoto: Function,
        getNode: Function,
        getNodes: Function,
	},

	watch: {
		$props: {
			deep: true,
			handler(value) { this.props = Object.assign({}, value); },
        },
    },

	methods: {
		// 
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
		};
	},
};</script>