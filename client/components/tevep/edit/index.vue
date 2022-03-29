<template>
    <div>
        <ui-browser-info v-model="browser"></ui-browser-info>
        
        <div style="display:flex; width:100%; overflow:hidden;">
            
            <!-- Nav -->
            <div class="d-none d-md-block" style="flex: 0 0 200px; background:var(--bs-dark);">
                <ui-nav :value="$route.query.tab" :items="navItems" text-color="#fff"></ui-nav>
            </div>
            
            <!-- Content -->
            <div style="flex: 0 1 auto; overflow-x:auto; display:flex; flex-direction:column;">
                <div class="d-md-none">
                    <div class="mb-3 d-md-none" style="overflow:auto;">
                        <div style="display:flex; white-space:nowrap;">
                            <template v-for="(n, i) in navItems">
                                <nuxt-link :to="n.to" class="btn btn-dark me-2">{{ n.label }}</nuxt-link>
            
                                <template v-for="(nn, ii) in (n.children||[])">
                                    <nuxt-link :to="nn.to" class="btn btn-dark me-2">{{ nn.label }}</nuxt-link>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>

                <div style="flex-grow:1; overflow-x:auto; min-height:300px;">
                    <div class="row g-0" style="width:1400px;">
            
                        <!-- Tempos -->
                        <div class="col-12 p-2">
                            <tevep-edit-draggable v-model="tevep.meta.tempos" v-if="tevep.meta" layout="horizontal" #default="v">
                                <div class="form-control form-control-sm p-0">
                                    <el-date-picker
                                        class="w-100"
                                        v-model="v.item.date_start"
                                        type="datetime"
                                        placeholder="Selecionar data/hora"
                                        value-format="yyyy-MM-dd HH:mm:ss"
                                        format="dd/MM/yyyy - HH:mm:ss"
                                    ></el-date-picker>
                                </div>
                            </tevep-edit-draggable>
                        </div>

                        <!-- Pilotos -->
                        <div class="col-3 p-2 d-flex align-items-center">
                            <tevep-edit-draggable v-model="tevep.meta.pilotos" style="min-width:228px;" v-if="tevep.meta" layout="vertical" #default="v">
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

                                <div class="text-center mt-2">
                                    <nuxt-link :to="{path:`/admin/teveps/${tevep.parent_id}`, query:{meta_ref:tevep.meta_ref}}"
                                        class="btn btn-primary btn-sm"
                                        v-if="tevep.parent_id"
                                    >
                                        <i class="fas fa-fw fa-level-up-alt"></i>
                                        Acessar Tevep pai</nuxt-link>
                                </div>
                            </div>
                        </div>

                        <!-- Convidados -->
                        <div class="col-3 p-2 d-flex align-items-center">
                            <img style="width:70px;" src="/assets/icons/publico.png" alt="" class="me-3">

                            <tevep-edit-draggable v-model="tevep.meta.convidados" style="min-width:228px;" v-if="tevep.meta" layout="vertical" #default="v">
                                <input type="text" class="form-control form-control-sm" v-model="v.item.name">
                            </tevep-edit-draggable>
                        </div>

                        <!-- Lugares -->
                        <div class="col-12 p-2">
                            <div class="text-center mb-3">
                                <img style="height:30px;" src="/assets/icons/espaco.png" alt="">
                            </div>
                            <tevep-edit-draggable v-model="tevep.meta.lugares" v-if="tevep.meta" layout="horizontal" #default="v">
                                <input type="text" class="form-control form-control-sm" v-model="v.item.name">
                            </tevep-edit-draggable>
                        </div>

                        <!-- <div class="col-12 p-2">
                            <pre>{{ tevep }}</pre>
                        </div> -->
                    </div>
                </div>

                <div class="p-3">
                    <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-preta.png" alt=""></a>
                    <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-amarela.png" alt=""></a>
                    <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-verde.png" alt=""></a>
                    <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-vermelha.png" alt=""></a>
                </div>
            </div>
        </div>
        
        <br><br>

        <div>

            <div class="mb-3 d-md-none" style="overflow:auto;">
                <div style="display:flex; white-space:nowrap;">
                    
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
            this.tevepDefault();
        }},
    },

    data() {
        return {
            tevep: this.$store.state.tevep.edit,
            browser: {},
            navItems: [
                {label:"Princípios", to:{query:{}}, children:[]},
                {label:"Fundamentos", to:"", children:[
                    {label:"Utilidades", to:{query:{tab:"utilidades"}}, children:[]},
                    {label:"Inerências", to:{query:{tab:"inerencias"}}, children:[]},
                    {label:"Expectativas", to:{query:{tab:"expectativas"}}, children:[]},
                    {label:"Inovações", to:{query:{tab:"inovacoes"}}, children:[]},
                    {label:"Logística", to:{query:{tab:"logistica"}}, children:[]},
                    {label:"Relevância", to:{query:{tab:"relevancia"}}, children:[]},
                    {label:"Complexidade", to:{query:{tab:"complexidade"}}, children:[]},
                ]},
                {label:"Custo", to:"", children:[
                    {label:"Custo", to:{query:{tab:"custo"}}, children:[]},
                    {label:"Entrega", to:{query:{tab:"entrega"}}, children:[]},
                    {label:"Segurança", to:{query:{tab:"seguranca"}}, children:[]},
                    {label:"Atendimento", to:{query:{tab:"atendimento"}}, children:[]},
                    {label:"Qualidade", to:{query:{tab:"qualidade"}}, children:[]},
                ]},
                {label:"Material", to:"", children:[
                    {label:"Material", to:{query:{tab:"material"}}, children:[]},
                    {label:"Máquina", to:{query:{tab:"maquina"}}, children:[]},
                    {label:"Mão de obra", to:{query:{tab:"mao-de-obra"}}, children:[]},
                    {label:"Meio ambiente", to:{query:{tab:"meio-ambiente"}}, children:[]},
                    {label:"Método", to:{query:{tab:"metodo"}}, children:[]},
                ]},
                {label:"RUT", to:{query:{tab:"rut"}}, children:[]},
            ],
        };
    },

    methods: {
        tevepDefault() {
            this.tevep.meta = this.tevep.meta || {};
            this.tevep.meta.tempos = this.tevep.meta.tempos || [];
            this.tevep.meta.pilotos = this.tevep.meta.pilotos || [];
            this.tevep.meta.convidados = this.tevep.meta.convidados || [];
            this.tevep.meta.lugares = this.tevep.meta.lugares || [];
        },
    },

    mounted() {
        this.tevepDefault();
    },
}
</script>