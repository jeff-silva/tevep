<template><div>
	<!--
    <app-footer>
		<template #content>
			<nuxt-link to="/tevep/0" class="btn btn-primary">
				<i class="fa fa-fw fa-plus"></i> Novo projeto
			</nuxt-link>
		</template>
	</app-footer>
    -->

    <tevep v-model="tevep"
        @init="initHandler($event)"
        @change="changeHandler($event)"
        style="margin:-16px;"
    >
        <template #header="bind">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <label class="input-group border-0 bg-white m-0">
                        <div class="input-group-prepend"><div class="input-group-text border-0">
                            Nome do projeto:
                        </div></div>
                        <input type="text" class="form-control border-0" v-model="bind.tevep.title">
                    </label>
                    <small class="text-danger" v-if="bind.error.title" v-html="bind.error.title"></small>
                </div>

                <div class="col-12 col-md-3">
                    <div class="input-group bg-white m-0">
                        <div class="input-group-prepend bg-transparent"><div class="input-group-text">
                            Divisor
                        </div></div>
                        <select class="form-control border-0" v-model="bind.tevep.divisor">
                            <option value="minutes">Minutos</option>
                            <option value="hours">Horas</option>
                            <option value="days">Dias</option>
                            <option value="weeks">Semanas</option>
                            <option value="months">Meses</option>
                            <option value="years">Anos</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-3 px-2 text-white" v-if="bind.tevep.nodes">
                    {{ bind.tevep.nodes.length }} itens - 
                    Nível {{ bind.node.level }}
                </div>
            </div>
        </template>

        <template #footer="bind">
            <div class="text-right">
                <button type="button" class="btn btn-primary" @click="bind.tevepSave()">
                    <i class="fa fa-fw fa-save"></i> Salvar
                </button>
            </div>
        </template>

        <!-- Princípios -->
        <template #principios="bind">
            <tevep-principios v-bind="bind"></tevep-principios>
        </template>

        
        <!-- Utilidade -->
        <template #utilidade="bind">
            <tevep-list v-bind="bind"
                v-model="bind.node.utilities"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>

        
        <!-- Inerências -->
        <template #inerencias="bind">
            <div class="row no-gutters">
                <div class="col-4">Aaaa</div>
                <div class="col-8">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>
        

        <!-- Expectativas -->
        <template #expectativas="bind">
            <div class="row no-gutters">
                <div class="col-4">Aaaa</div>
                <div class="col-8">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Inovações -->
        <template #inovacoes="bind">
            <div class="row no-gutters">
                <div class="col-4">Aaaa</div>
                <div class="col-8">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Logística -->
        <template #logistica="bind">
            <div class="row no-gutters">
                <div class="col-4">Aaaa</div>
                <div class="col-8">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Relevância -->
        <template #relevancia="bind">
            <div class="row no-gutters">
                <div class="col-4">Aaaa</div>
                <div class="col-8">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Complexidade -->
        <template #complexidade="bind">
            <div class="row no-gutters">
                <div class="col-4">Aaaa</div>
                <div class="col-8">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Custo -->
        <template #custo="bind">
            <tevep-list
                v-model="bind.node.costs"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Entrega -->
        <template #entrega="bind">
            <tevep-list
                v-model="bind.node.delivery"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>

        
        <!-- Segurança -->
        <template #seguranca="bind">
            <tevep-list
                v-model="bind.node.safety"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Atendimento -->
        <template #atendimento="bind">
            <tevep-list
                v-model="bind.node.attendance"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Qualidade -->
        <template #qualidade="bind">
            <tevep-list
                v-model="bind.node.quality"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Máquina -->
        <template #maquina="bind">
            <tevep-list
                v-model="bind.node.machine"
                :headers="[{id:'name', name:'Medida'}, {id:'machine', name:'Máquina'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Material -->
        <template #material="bind">
            <tevep-list
                v-model="bind.node.material"
                :headers="[{id:'name', name:'Nome'}, {id:'material', name:'Material'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Mão de obra -->
        <template #mao-de-obra="bind">
            <tevep-list
                v-model="bind.node.labor"
                :headers="[{id:'name', name:'Nome'}, {id:'labor', name:'Mão de obra'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>

        
        <!-- Meio ambiente -->
        <template #meio-ambiente="bind">
            <tevep-list
                v-model="bind.node.environment"
                :headers="[{id:'name', name:'Nome'}, {id:'environment', name:'Meio ambiente'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Método -->
        <template #metodo="bind">
            <tevep-list
                v-model="bind.node.methods"
                :headers="[{id:'name', name:'Nome'}, {id:'method', name:'Método'}]"
                @input="bind.emit()"
            ></tevep-list>
        </template>


        <!-- Rut -->
        <template #rut="bind">
            <div style="overflow:auto;">
                <table class="table table-sm table-bordered">
                    <colgroup>
                        <col width="30%">
                        <col width="*">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Duração</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="i in bind.rut.items">
                            <td>{{ i.node.title }}</td>
                            <td><div :style="`background:red; color:#fff; margin-left:${i.percent}%; width:${i.duration}%;`">{{ i.percent }}%</div></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <pre>rut: {{ bind.rut }}</pre> -->
            </div>
        </template>
    </tevep>
</div></template>

<script>
export default {
	layout: 'admin',
    middleware: 'auth',

	methods: {
		initHandler(bind) {
			this.$set(this, 'tevep', bind.tevep);
			this.$set(this, 'tabs', bind.tabs);
			this.$router.push({
				query: {
					node: bind.node.id,
					tab: bind.tabId,
				},
			});
		},


		changeHandler(bind) {
			console.log(bind.tevep);
			// this.$set(this, 'tevep', bind.tevep);
		},
	},

	data() {
		return {
			tevep: {},
			tabs: [],
		};
	},
}
</script>