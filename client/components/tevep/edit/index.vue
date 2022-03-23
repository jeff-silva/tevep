<template>
    <div class="d-flex">
        <div class="bg-dark" style="min-width:200px; max-width:200px;">
            <ui-nav :items="navItems" text-color="#fff"></ui-nav>
        </div>

        <!--
        <img style="height:20px;" src="/assets/icons/raquete-amarela.png" alt="">
        <img style="height:20px;" src="/assets/icons/raquete-preta.png" alt="">
        <img style="height:20px;" src="/assets/icons/raquete-verde.png" alt="">
        <img style="height:20px;" src="/assets/icons/raquete-vermelha.png" alt="">
        -->

        <div class="flex-grow-1" style="overflow:auto;" v-if="tevep.meta">
            <div class="row g-0" style="width:1400px;">

                <!-- Tempos -->
                <div class="col-12 p-2">
                    <tevep-edit-draggable v-model="tevep.meta.tempos" layout="horizontal" #default="v">
                        <div class="form-control form-control-sm p-0">
                            <el-date-picker
                                class="w-100"
                                v-model="v.item.date_start"
                                type="datetime"
                                placeholder="Selecionar data/hora"
                            ></el-date-picker>
                        </div>
                    </tevep-edit-draggable>
                </div>
    
                <!-- Pilotos -->
                <div class="col-3 p-2 d-flex align-items-center">
                    <tevep-edit-draggable v-model="tevep.meta.pilotos" layout="vertical" #default="v">
                        <input type="text" class="form-control form-control-sm" v-model="v.item.name">
                    </tevep-edit-draggable>

                    <img style="width:50px;" src="/assets/icons/piloto.png" alt="" class="ms-3">
                </div>
    
                <!-- Nome -->
                <div class="col-6 p-2 d-flex align-items-center justify-content-center" style="min-height:200px;">
                    <div>
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <el-date-picker
                                    class="w-100"
                                    v-model="tevep.date_start"
                                    type="datetime"
                                    placeholder="Selecionar data/hora"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    format="dd/MM/yyyy - HH:mm:ss"
                                ></el-date-picker>
                            </div>
                            <div class="flex-grow-1 px-4 text-center">
                                <img style="height:70px;" src="/assets/icons/ampulheta.png" alt="">
                            </div>
                            <div>
                                <el-date-picker
                                    class="w-100"
                                    v-model="tevep.date_final"
                                    type="datetime"
                                    placeholder="Selecionar data/hora"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    format="dd/MM/yyyy - HH:mm:ss"
                                ></el-date-picker>
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <img style="height:70px;" src="/assets/icons/evento.png" alt="">
                        </div>
                        <input type="text" class="form-control form-control-sm mx-auto" style="max-width:400px;" v-model="tevep.name">
                    </div>
                </div>
    
                <!-- Convidados -->
                <div class="col-3 p-2 d-flex align-items-center">
                    <img style="width:70px;" src="/assets/icons/publico.png" alt="" class="me-3">

                    <tevep-edit-draggable v-model="tevep.meta.convidados" layout="vertical" #default="v">
                        <input type="text" class="form-control form-control-sm" v-model="v.item.name">
                    </tevep-edit-draggable>
                </div>
    
                <!-- Lugares -->
                <div class="col-12 p-2">
                    <div class="text-center mb-3">
                        <img style="height:30px;" src="/assets/icons/espaco.png" alt="">
                    </div>
                    <tevep-edit-draggable v-model="tevep.meta.lugares" layout="horizontal" #default="v">
                        <input type="text" class="form-control form-control-sm" v-model="v.item.name">
                    </tevep-edit-draggable>
                </div>
    
                <div class="col-12 p-2">
                    <!-- <pre>{{ tevep }}</pre> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    watch: {
        '$store.state.tevep.edit': {handler(value) {
            this.tevep = value;
        }},
    },

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