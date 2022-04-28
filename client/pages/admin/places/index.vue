<template>
	<ui-model-search
		model-name="places"
		singular="Item"
		plural="Itens"
		:actions-except="['clone', 'delete']"
		@response="handleFormResponse($event)"
	>
		<template #table-header>
			<th data-orderby="name">Nome</th>
			<th data-orderby="city">Localidade</th>
		</template>
		
		<template #table-row="{item}">
			<td>{{ item.formatted }}</td>
			<td>{{ [item.city, item.state_short, item.country].filter(item => item).join('/') }}</td>
		</template>

		<template #search-fields="bind">
			<ui-field label="País">
				<select class="form-control" v-model="bind.params.country_short">
					<option :value="null">País</option>
					<option :value="a.country_short" v-for="a in bind.response.attributes.countries||[]">
						{{ a.country }}
					</option>
				</select>
			</ui-field>
			
			<ui-field label="Estado" v-if="bind.response.attributes.states && bind.response.attributes.states.length">
				<label class="d-flex align-items-center" v-for="a in (bind.response.attributes && bind.response.attributes.states)">
					<input type="checkbox" class="form-control" v-model="bind.params.state_short" :true-value="a.state_short" :false-value="null">
					<span class="ms-2">{{ a.state }}</span>
				</label>
			</ui-field>
		</template>

		<template #resume="resume">
			<l-map ref="map" style="height:300px;">
				<l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
				<l-marker :lat-lng="[p.lat, p.lng]" v-for="p in resume.response.data" :key="p.id"></l-marker>
			</l-map>
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

	methods: {
		handleFormResponse(ev) {
			setTimeout(() => {
				if (!this.$refs.map) return;
				let bounds = ev.data.map(place => [place.lat, place.lng]);
				if (bounds.length==0) return;
				this.$refs.map.mapObject.fitBounds(new L.LatLngBounds(bounds));
			}, 100);
		},
	},
}
</script>