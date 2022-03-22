<template>
    <div class="d-flex">
        <div class="bg-dark" style="min-width:200px; max-width:200px;">
            <ui-nav :items="navItems" text-color="#fff"></ui-nav>
        </div>

        <div class="flex-grow-1" style="max-width:1150px; overflow:auto;" v-if="tevep.meta">
            <div class="row g-0" style="width:1500px; border:solid 1px red;">

                <!-- Tempos -->
                <div class="col-12 p-2">
                    <tevep-edit-draggable v-model="tevep.meta.tempos" layout="horizontal" #default="v">
                        <div class="form-control p-0">
                            <el-date-picker
                                v-model="v.item.date_start"
                                type="datetime"
                                placeholder="Selecionar data/hora"
                            ></el-date-picker>
                        </div>
                    </tevep-edit-draggable>
                </div>
    
                <!-- Pilotos -->
                <div class="col-3 p-2">
                    <tevep-edit-draggable v-model="tevep.meta.pilotos" layout="vertical" #default="v">
                        <input type="text" class="form-control" v-model="v.item.name">
                    </tevep-edit-draggable>
                </div>
    
                <!-- Nome -->
                <div class="col-6 p-2">
                    <input type="text" class="form-control" v-model="tevep.name">
                </div>
    
                <!-- Convidados -->
                <div class="col-3 p-2">
                    <tevep-edit-draggable v-model="tevep.meta.convidados" layout="vertical" #default="v">
                        <input type="text" class="form-control" v-model="v.item.name">
                    </tevep-edit-draggable>
                </div>
    
                <!-- Lugares -->
                <div class="col-12 p-2">
                    <tevep-edit-draggable v-model="tevep.meta.lugares" layout="horizontal" #default="v">
                        <input type="text" class="form-control" v-model="v.item.name">
                    </tevep-edit-draggable>
                </div>
    
                <div class="col-12 p-2">
                    <pre>{{ tevep }}</pre>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tevep: this.$store.state.tevep.edit,
            navItems: [
                {label:"Princípios", to:"", children:[]},
                {label:"Fundamentos", to:"", children:[
                    {label:"Utilidades", to:"", children:[]},
                    {label:"Inerências", to:"", children:[]},
                    {label:"Expectativas", to:"", children:[]},
                    {label:"Inovações", to:"", children:[]},
                    {label:"Logística", to:"", children:[]},
                    {label:"Relevância", to:"", children:[]},
                    {label:"Complexidade", to:"", children:[]},
                ]},
                {label:"Custo", to:"", children:[
                    {label:"Custo", to:"", children:[]},
                    {label:"Entrega", to:"", children:[]},
                    {label:"Segurança", to:"", children:[]},
                    {label:"Atendimento", to:"", children:[]},
                    {label:"Qualidade", to:"", children:[]},
                ]},
                {label:"Material", to:"", children:[
                    {label:"Material", to:"", children:[]},
                    {label:"Máquina", to:"", children:[]},
                    {label:"Mão de obra", to:"", children:[]},
                    {label:"Meio ambiente", to:"", children:[]},
                    {label:"Método", to:"", children:[]},
                ]},
                {label:"RUT", to:"", children:[]},
            ],
        };
    },
}
</script>