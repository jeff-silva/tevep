<template><div>
	<div class="row no-gutters mb-3">
		<div class="col-12" v-if="node.show>=4 || node.level>0">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/evento.png')" alt="" style="width:80px;"></div>

			<tevep-dates v-model="props.nodeChildren"
                type="time"
				:horizontal="true"
                placeholder="Tempo"
                v-bind="props"
				@input="node.show=(node.show==4? 5: node.show)"
            ></tevep-dates>
		</div>
	</div>

	<br><br>

	<div class="row no-gutters align-items-center">
		<div class="col-3">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/evento.png')" alt="" style="width:80px;"></div>

            <tevep-dates v-model="props.nodeChildren"
                type="user"
				:horizontal="false"
                placeholder="Piloto"
                v-bind="props"
				@input="node.show=(node.show==3? 4: node.show)"
				v-if="node.show>=3 || node.level>0"
            ></tevep-dates>
		</div>

		<div class="col-6 p-2">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/evento.png')" alt="" style="width:80px;"></div>

			<div class="input-group mb-2" v-if="node.show>=1 || node.level>0">
				<ui-datepicker v-model="node.date_start" placeholder="Início"></ui-datepicker>
				<ui-datepicker v-model="node.date_final" placeholder="Fim"></ui-datepicker>
				<div class="input-group-append" v-if="node.show==1 || node.level>0"><div class="input-group-btn">
					<button type="button" class="btn btn-primary" @click="node.show+=1">
						<i class="fas fa-save"></i>
					</button>
				</div></div>
			</div>

			<div class="input-group">
				<div class="input-group-prepend"><div class="input-group-text" style="width:70px;">
					Nome
				</div></div>
				<input type="text" class="form-control" v-model="node.title" @keyup="tevep.title = (node.level==0)? node.title: tevep.title;">
				
				<div class="input-group-append"><div class="input-group-btn" v-if="nodeParent.id">
					<nuxt-link :to="{query:{node:nodeParent.id, tab:$route.query.tab}}" class="btn btn-primary" v-tooltip="'Voltar um nível'">
						<i class="fas fa-level-up-alt"></i>
					</nuxt-link>
				</div></div>

				<div class="input-group-append" v-if="node.show==0 || node.level>0"><div class="input-group-btn">
					<button type="button" class="btn btn-primary" @click="node.show=1">
						<i class="fas fa-save"></i>
					</button>
				</div></div>
			</div>
		</div>

		<div class="col-3">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/evento.png')" alt="" style="width:80px;"></div>

			<tevep-dates v-model="props.nodeChildren"
                type="target"
				:horizontal="false"
                placeholder="Pessoas"
                v-bind="props"
				@input="node.show=(node.show==3? 4: node.show)"
				v-if="node.show>=3 || node.level>0"
            ></tevep-dates>
		</div>
	</div>

	<br><br>

	<div class="row no-gutters mt-3" v-if="node.show>=2 || node.level>0">
		<div class="text-center mb-3"><img :src="require('@/assets/icons/evento.png')" alt="" style="width:80px;"></div>
		
		<div class="col-12">
			<tevep-dates v-model="props.nodeChildren"
                type="space"
				:horizontal="true"
                placeholder="Espaço"
                v-bind="props"
				@input="node.show=(node.show==2? 3: node.show)"
            ></tevep-dates>
		</div>
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
		tevep: {default:()=>({})},
		node: {default:()=>({})},
		nodeChildren: {default:()=>([])},
		nodeParent: {default:()=>({})},
		nodeChangeDate: {default:()=>({})},
        nodeGoto: Function,
        getNode: Function,
        getNodes: Function,
        nodeAdd: Function,
        nodeRemove: Function,
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