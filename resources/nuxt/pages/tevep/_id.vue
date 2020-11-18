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
        style="margin:-32px -25px 0px -30px;"
    >
        <template #header="bind">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-2 mb-md-0">
                    <label class="input-group border-0 bg-white m-0" style="max-width:500px;">
                        <div class="input-group-prepend"><div class="input-group-text border-0">
                            Nome do projeto:
                        </div></div>
                        <input type="text" class="form-control border-0" v-model="bind.tevep.title">
                    </label>
                    <small class="text-danger" v-if="bind.error.title" v-html="bind.error.title"></small>
                </div>

                <!-- <div class="col-12 col-md-3 mb-1 mb-md-0">
                    <div class="input-group bg-white m-0" style="max-width:500px;">
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
                </div> -->

                <!-- <div class="col-12 col-md-3 px-2 text-white" v-if="bind.tevep.nodes">
                    {{ bind.tevep.nodes.length }} itens - 
                    Nível {{ bind.node.level }}
                </div> -->
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
                singular="Utilidade"
                style="max-width:600px;"
            ></tevep-list>
        </template>

        
        <!-- Inerências -->
        <template #inerencias="bind">
            <div class="row no-gutters">
                <div class="col-5 pr-3">
                    <tevep-list v-model="bind.node.inherences" singular="Inerência">
                        <template #fields="{item}">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name" style="width:150px;">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                        </template>
                    </tevep-list>
                </div>
                <div class="col-7">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>
        

        <!-- Expectativas -->
        <template #expectativas="bind">
            <div class="row no-gutters">
                <div class="col-5 pr-3">
                    <tevep-list v-model="bind.node.expectations" singular="Expectativa">
                        <template #fields="{item}">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name" style="width:150px;">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                        </template>
                    </tevep-list>
                </div>
                <div class="col-7">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Inovações -->
        <template #inovacoes="bind">
            <div class="row no-gutters">
                <div class="col-5 pr-3">
                    <tevep-list v-model="bind.node.innovations" singular="Inovação">
                        <template #fields="{item}">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name" style="width:150px;">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                        </template>
                    </tevep-list>
                </div>
                <div class="col-7">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Logística -->
        <template #logistica="bind">
            <div class="row no-gutters">
                <div class="col-5 pr-3">
                    <tevep-list v-model="bind.node.logistics" singular="Logística">
                        <template #fields="{item}">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name" style="width:150px;">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                        </template>
                    </tevep-list>
                </div>
                <div class="col-7">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Relevância -->
        <template #relevancia="bind">
            <div class="row no-gutters">
                <div class="col-5 pr-3">
                    <tevep-list v-model="bind.node.relevance" singular="Relevância">
                        <template #fields="{item}">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name" style="width:150px;">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                        </template>
                    </tevep-list>
                </div>
                <div class="col-7">
                    <tevep-principios v-bind="bind"></tevep-principios>
                </div>
            </div>
        </template>


        <!-- Complexidade -->
        <template #complexidade="bind">
            <div class="row no-gutters">
                <div class="col-5 pr-3">
                    <tevep-list v-model="bind.node.complexity" singular="Complexidade">
                        <template #fields="{item}">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name" style="width:150px;">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                            <input type="text" class="form-control" v-model="item.name">
                        </template>
                    </tevep-list>
                </div>
                <div class="col-7">
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
                singular="Custo"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Entrega -->
        <template #entrega="bind">
            <tevep-list
                v-model="bind.node.delivery"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
                singular="Entrega"
                style="max-width:600px;"
            ></tevep-list>
        </template>

        
        <!-- Segurança -->
        <template #seguranca="bind">
            <tevep-list
                v-model="bind.node.safety"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
                singular="Segurança"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Atendimento -->
        <template #atendimento="bind">
            <tevep-list
                v-model="bind.node.attendance"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
                singular="Atendimento"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Qualidade -->
        <template #qualidade="bind">
            <tevep-list
                v-model="bind.node.quality"
                :headers="[{id:'name', name:'Nome'}]"
                @input="bind.emit()"
                singular="Qualidade"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Máquina -->
        <template #maquina="bind">
            <tevep-list
                v-model="bind.node.machine"
                :headers="[{id:'name', name:'Medida'}, {id:'machine', name:'Máquina'}]"
                @input="bind.emit()"
                singular="Máquina"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Material -->
        <template #material="bind">
            <tevep-list
                v-model="bind.node.material"
                :headers="[{id:'name', name:'Nome'}, {id:'material', name:'Material'}]"
                @input="bind.emit()"
                singular="Material"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Mão de obra -->
        <template #mao-de-obra="bind">
            <tevep-list
                v-model="bind.node.labor"
                :headers="[{id:'name', name:'Nome'}, {id:'labor', name:'Mão de obra'}]"
                @input="bind.emit()"
                singular="Mão de obra"
                style="max-width:600px;"
            ></tevep-list>
        </template>

        
        <!-- Meio ambiente -->
        <template #meio-ambiente="bind">
            <tevep-list
                v-model="bind.node.environment"
                :headers="[{id:'name', name:'Nome'}, {id:'environment', name:'Meio ambiente'}]"
                @input="bind.emit()"
                singular="Meio ambiente"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Método -->
        <template #metodo="bind">
            <tevep-list
                v-model="bind.node.methods"
                :headers="[{id:'name', name:'Nome'}, {id:'method', name:'Método'}]"
                @input="bind.emit()"
                singular="Método"
                style="max-width:600px;"
            ></tevep-list>
        </template>


        <!-- Rut -->
        <template #rut="bind">
            <table class="table table-borderless table-striped bg-white shadow-sm">
                <tbody>
                    <tr v-for="i in bind.rut.items">
                        <td>
                            <div class="mb-2">
                                <strong>{{ i.node.title }}</strong> - 
                                <small>{{ i.node.date_start|datetime }} ~ {{ i.node.date_final|datetime }}</small>
                            </div>
                            <div :style="i.style"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <pre>{{ bind.rut }}</pre> -->
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
    
    mounted() {
        // this.$fire.database.ref('teveps').on('value', (snap) => {
        //     console.log(snap.val());
        // });
    },
}
</script>