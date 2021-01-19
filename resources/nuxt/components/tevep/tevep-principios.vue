<template><div>
	<div class="row no-gutters mb-3">
		<div class="col-12 bg-white shadow-sm p-2">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/tempo.png')" alt="" style="width:50px;"></div>

			<tevep-dates v-model="props.nodeChildren"
                type="time"
				:horizontal="true"
                placeholder="Tempo"
                v-bind="props"
				@input="node.show=(node.level==0 && node.show==4? 5: node.show)"
				v-if="node.level==0 && node.show>=4"
				:show-add-button="node.level>0"
            ></tevep-dates>
		</div>
	</div>

	<div class="row no-gutters">
		<div class="col-3 bg-white shadow-sm p-2">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/piloto.png')" alt="" style="width:40px;"></div>

            <tevep-dates v-model="props.nodeChildren"
                type="user"
				:horizontal="false"
                placeholder="Piloto"
                v-bind="props"
				@input="node.show=(node.level==0 && node.show==3? 4: node.show)"
				v-if="node.level==0 && node.show>=3"
				:show-add-button="node.level>0"
            ></tevep-dates>
		</div>

		<div class="col-6 px-3">
			<div class="bg-white shadow-sm p-2">
				<div class="input-group mb-2" v-if="node.level==0 && node.show>=1">
					<ui-datepicker v-model="node.date_start" placeholder="Início"></ui-datepicker>
					<ui-datepicker v-model="node.date_final" placeholder="Fim"></ui-datepicker>
					<div class="input-group-append" v-if="node.level==0 && node.show==1"><div class="input-group-btn">
						<button type="button" class="btn btn-primary" @click="node.show+=1">
							<i class="fas fa-save"></i>
						</button>
					</div></div>
				</div>

				<br><br>
				<div class="text-center mb-3"><img :src="require('@/assets/icons/evento.png')" alt="" style="width:70px;"></div>

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

					<div class="input-group-append" v-if="node.level==0 && node.show==0"><div class="input-group-btn">
						<button type="button" class="btn btn-primary" @click="node.show=1">
							<i class="fas fa-save"></i>
						</button>
					</div></div>
				</div>
			</div>
		</div>

		<div class="col-3 bg-white shadow-sm p-2">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/pessoa.png')" alt="" style="width:60px;"></div>

			<tevep-dates v-model="props.nodeChildren"
                type="target"
				:horizontal="false"
                placeholder="Pessoas"
                v-bind="props"
				@input="node.show=(node.level==0 && node.show==3? 4: node.show)"
				v-if="node.level==0 && node.show>=3"
				:show-add-button="node.level>0"
            ></tevep-dates>
		</div>
	</div>

	<div class="row no-gutters mt-3">
		<div class="col-12 bg-white shadow-sm p-2">
			<div class="text-center mb-3"><img :src="require('@/assets/icons/espaco.png')" alt="" style="width:120px;"></div>

			<tevep-dates v-model="props.nodeChildren"
                type="space"
				:horizontal="true"
                placeholder="Espaço"
                v-bind="props"
				@input="node.show=(node.level==0 && node.show==2? 3: node.show)"
				v-if="node.level==0 && node.show>=2"
				:show-add-button="node.level>0"
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