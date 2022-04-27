<template>
	<ui-model-edit
		model-name="users-groups"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, validate}"
	>
		<ui-field label="Nome" :validate="validate.test('name')">
			<input type="text" class="form-control" v-model="value.name">
		</ui-field>

		<ui-field label="Permissões" :validate="validate.test('permissions')">
			<el-select v-model="value.permissions" class="w-100" filterable multiple :disabled="value.id==1">
				<el-option v-for="p in permissions" :key="p.key" :value="p.key" :label="p.name">
					{{ p.name }}
				</el-option>
			</el-select>

			<div class="d-flex mt-1" v-if="value.id!=1">
				<button type="button" class="btn btn-primary btn-sm" @click="value.permissions=permissions.map(p => p.key)">Adicionar todas</button>
				<div class="ms-1"></div>
				<button type="button" class="btn btn-primary btn-sm" @click="value.permissions=[]">Remover todas</button>
			</div>
		</ui-field>
	</ui-model-edit>
</template>

<script>
export default {
	head() {
		return {
			title: "Editar grupo",
		};
	},

	data() {
		return {
			permissions: [],
		};
	},

	methods: {
		permissionsList() {
			this.$axios.get('/api/users-groups/permissions').then(resp => {
				this.permissions = resp.data;
			});
		},
	},

	mounted() {
		this.permissionsList();
	},
}
</script>