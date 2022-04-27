<template>
	<ui-model-search
		model-name="places"
		singular="Item"
		plural="Itens"
		:actions-except="['clone', 'delete']"
	>
		<template #table-header>
			<th data-orderby="name">Nome</th>
			<th data-orderby="city">Localidade</th>
		</template>
		
		<template #table-row="{item}">
			<td>{{ item.formatted }}</td>
			<td>{{ [item.city, item.state_short, item.country].filter(item => item).join('/') }}</td>
		</template>

		<template #search-fields="{ response, searchParams }">
			<ui-field label="País">
				<select class="form-control" v-model="searchParams.country_short">
					<option :value="null">País</option>
					<option :value="a.country_short" v-for="a in (response.attributes && response.attributes.countries)">
						{{ a.country }}
					</option>
				</select>
			</ui-field>
			
			<ui-field label="Estado">
				<select class="form-control" v-model="searchParams.state_short">
					<option :value="null">Estado</option>
					<option :value="a.state_short" v-for="a in (response.attributes && response.attributes.states)">
						{{ a.state }}
					</option>
				</select>
			</ui-field>
		</template>
	</ui-model-search>
</template>

<script>
export default {
	head() {
		return {
			title: "Buscar endereços",
		};
	},
}
</script>