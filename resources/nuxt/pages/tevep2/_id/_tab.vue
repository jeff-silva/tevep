<template><div style="margin:-30px -30px 0px -30px;">
    <div class="d-flex" style="min-width:1000px; overflow:auto;">
        <div class="bg-dark text-white" style="height:calc(100vh - 110px);">
            <ul class="tevep-nav">
                <li v-for="i in compNavItems">
                    <nuxt-link class="d-block text-white"
                        :class="{'tevep-nav-active':i.to.path==$route.path}"
                        :to="i.to"
                    >
                        <img :src="i.icon" alt="" v-if="i.icon">
                        <span v-else v-html="i.title"></span>
                    </nuxt-link>
                    <ul>
                        <li v-for="ii in i.children">
                            <nuxt-link class="d-block text-white"
                                :class="{'tevep-nav-active':ii.to.path==$route.path}"
                                :to="ii.to" v-html="ii.title"
                            ></nuxt-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="flex-grow-1">
            <div style="height:calc(100vh - 160px); overflow:auto;">

                <!-- if empty -->
                <div class="text-muted p-2" v-if="$route.matched.length==1">
                    <nuxt-child-default v-bind.sync="compBind"></nuxt-child-default>
                </div>

                <nuxt-child class="p-1" v-bind.sync="compBind"></nuxt-child>
                <pre>compBind.tevep: {{ compBind.tevep }}</pre>
                <!-- <pre>compBind: {{ Object.keys(compBind) }}</pre> -->
            </div>
            <div class="bg-white shadow-sm p-2 text-right">
                <nuxt-link class="btn btn-link float-left" to="/tevep2/">Voltar</nuxt-link>

                <button type="submit" class="btn btn-primary">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div></template>

<style>
ul.tevep-nav * {transition: all 200ms ease;}
ul.tevep-nav {list-style-type:none; padding:0px; margin:0px; width:150px;}
ul.tevep-nav > li {position:relative;}
ul.tevep-nav > li > a {display:block; text-align:center;}
ul.tevep-nav > li > a.tevep-nav-active,
ul.tevep-nav > li > a:active,
ul.tevep-nav > li:hover > a {background:#ffffff22;}
ul.tevep-nav > li > a > img {position:relative; height:70px; margin:10px;}
ul.tevep-nav > li > a > span {display:block; padding:25px 0px;}
ul.tevep-nav > li > ul {list-style-type:none; padding:0px; margin:0px; position:absolute; top:0px; left:100%; width:150px; background:var(--dark); visibility:hidden; opacity:0; z-index:10;}
ul.tevep-nav > li > ul > li > a {display:block; padding:5px;}
ul.tevep-nav > li > ul > li > a.tevep-nav-active,
ul.tevep-nav > li > ul > li:hover > a {background:#fff; color:var(--dark) !important}

ul.tevep-nav > li:hover > ul {visibility:visible; opacity:1;}
</style>

<script>
import NuxtChildDefault from '@/pages/tevep2/_id/_tab/principios.vue';

export default {
    layout: 'admin',
    middleware: 'auth',
    components: {NuxtChildDefault},

    data() {
        return {
            tevep: this.tevepDefault(),
        };
    },

    methods: {
        uuid(prefix='', format='xxxxxxxxxx') {
			return prefix+format.replace(/[xy]/g, function(c) {
				var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			});
		},

        tevepRefresh() {
            if (this.compBind.node.parent==false) {
                this.tevep.title = this.compBind.node.title; 
                this.tevep.date_start = this.compBind.node.date_start;
                this.tevep.date_final = this.compBind.node.date_final;
            }
        },

        tevepDefault(tevep={}) {
            tevep = Object.assign({
                title: "",
                date_start: "",
                date_final: "",
                nodes: [],
                pingpongs: [],
            }, tevep);

            if (tevep.nodes.length==0) {
                tevep.nodes.push(this.tevepNodeDefault());
            }

            tevep.nodes = tevep.nodes.map(node => {
                return this.tevepNodeDefault(node);
            });

            return tevep;
        },

        tevepNodeDefault(node={}) {
            node = Object.assign({
                id: this.uuid('node-'),
                parent: false,
                title: '',
                level: 0,
                date_start: '',
                date_final: '',
                tempos: [],
                piloto: '',
                pilotos: [],
                pessoa: '',
                pessoas: [],
                espaco: '',
                espacos: [],
                utilidades: [],
				inerencias: [],
				expectativas: [],
				inovacoes: [],
				logisticas: [],
				relevancias: [],
				complecidades: [],
				custos: [],
				entregas: [],
				segurancas: [],
				atendimentos: [],
				qualidades: [],
				materiais: [],
				maquinas: [],
				mao_de_obra: [],
				meio_ambientes: [],
				metodos: [],
            }, node);

            if (node.tempos.length<7) {
                for(let t=1; t<=7; t++) {
                    if (node.tempos[t-1]) continue;
                    node.tempos.push({
                        title: `T${t}`,
                        date_start: '',
                        date_final: '',
                    });
                }
            }

            return node;
        },

        tevepNodeAdd(node={}) {
            node = this.tevepNodeDefault(node);
            this.tevep.nodes.push(node);
        },

        tevepNodeRemove(node={}) {
            // Remover filhos recursivamente
        },

        tevepNodeGetAll(params={}) {
			let nodes = this.tevep.nodes||[];

            ['id', 'parent', 'type'].forEach((kkey) => {
                if (params[kkey]) {
                    nodes = nodes.filter((node) => {
                        return node[kkey]==params[kkey];
                    });
                }
            });

			return nodes;
		},

		tevepNodeGet(params={}) {
			let nodes = this.tevepNodeGetAll(params);
			return nodes[0]? nodes[0]: {};
		},

        tevepPingpongDefault(pingpong={}) {
            pingpong = Object.assign({
                from: this.$auth.user.id,
                to: false,
                nodeId: this.$route.query.node,
                accepted: false,
            }, pingpong);

            return pingpong;
        },

        tevepPingpongAdd(pingpong={}) {
            pingpong = this.tevepPingpongDefault(pingpong);
            this.tevep.pingpongs.push(pingpong);
        },
    },

    computed: {
        compBind() {
            let data = {};

            data.nodeId = this.$route.query.node;
            data.node = this.tevepNodeGet({id:data.nodeId});
            data.root = this.tevepNodeGet({parent:false});
            data.parent = (data.node.parent? this.tevepNodeGet({id:data.node.parent}): {});
            data.childs = this.tevepNodeGetAll({parent:data.nodeId});
            data.tevep = this.tevep;
            
            // Metodos
            data.tevepRefresh = this.tevepRefresh;
            data.tevepDefault = this.tevepDefault;
            data.tevepNodeDefault = this.tevepNodeDefault;
            data.tevepNodeAdd = this.tevepNodeAdd;
            data.tevepNodeRemove = this.tevepNodeRemove;
            data.tevepNodeGetAll = this.tevepNodeGetAll;
            data.tevepNodeGet = this.tevepNodeGet;

            return data;
        },

        compNavItems() {
            return [
                {
                    title: "Princípios",
                    icon: false,
                    to: {path:`/tevep2/${this.$route.params.id}/principios/`, query:this.$route.query},
                    children: [],
                },
                {
                    title: "Fundamentos",
                    icon: false,
                    to: {path:`/tevep2/${this.$route.params.id}/utilidades/`, query:this.$route.query},
                    children: [
                        {
                            title: "Utilidades",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/utilidades/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Inerências",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/inerencias/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Expectativas",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/expectativas/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Inovações",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/inovacoes/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Logística",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/logistica/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Relevância",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/relevancia/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Complexidade",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/complexidade/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "Cesaq",
                    icon: require('@/assets/icons/estrela.png'),
                    to: {path:`/tevep2/${this.$route.params.id}/custo/`, query:this.$route.query},
                    children: [
                        {
                            title: "Custo",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/custo/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Entrega",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/entrega/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Segurança",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/seguranca/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Atendimento",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/atendimento/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Qualidade",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/qualidade/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "Material",
                    icon: require('@/assets/icons/flor.png'),
                    to: {path:`/tevep2/${this.$route.params.id}/material/`, query:this.$route.query},
                    children: [
                        {
                            title: "Material",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/material/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Máquina",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/maquina/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Mão de obra",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/mao-de-obra/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Meio ambiente",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/meio-ambiente/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Método",
                            icon: false,
                            to: {path:`/tevep2/${this.$route.params.id}/metodo/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "RUT",
                    icon: require('@/assets/icons/rut.png'),
                    to: {path:`/tevep2/${this.$route.params.id}/rut/`, query:this.$route.query},
                    children: [],
                },
            ];
        },
    },

    mounted() {
        // this.tevep = this.tevepDefault({"title":"festa","date_start":"2021-02-02T00:15:00.000Z","date_final":"2021-03-01T00:15:00.000Z","nodes":[{"id":"node-06d0e3cd1e","parent":false,"title":"festa","level":0,"date_start":"2021-02-02T00:27:00.000Z","date_final":"2021-03-01T00:28:00.000Z","tempos":[{"title":"T1","date_start":"","date_final":""},{"title":"T2","date_start":"","date_final":""},{"title":"T3","date_start":"","date_final":""},{"title":"T4","date_start":"","date_final":""},{"title":"T5","date_start":"","date_final":""},{"title":"T6","date_start":"","date_final":""},{"title":"T7","date_start":"","date_final":""}],"piloto":"Fulano","pilotos":[],"pessoa":"Sicrano","pessoas":[],"espaco":"Casa do shana","espacos":[],"utilidades":[],"inerencias":[],"expectativas":[],"inovacoes":[],"logisticas":[],"relevancias":[],"complecidades":[],"custos":[],"entregas":[],"segurancas":[],"atendimentos":[],"qualidades":[],"materiais":[],"maquinas":[],"mao_de_obra":[],"meio_ambientes":[],"metodos":[]}],"id":"node-c172c3af10","parent":false,"level":0,"tempos":[{"title":"T1","date_start":"","date_final":""},{"title":"T2","date_start":"","date_final":""},{"title":"T3","date_start":"","date_final":""},{"title":"T4","date_start":"","date_final":""},{"title":"T5","date_start":"","date_final":""},{"title":"T6","date_start":"","date_final":""},{"title":"T7","date_start":"","date_final":""}],"piloto":"Shana","pilotos":[],"pessoa":"Fulano","pessoas":[],"espaco":"minha casa","espacos":[],"utilidades":[],"inerencias":[],"expectativas":[],"inovacoes":[],"logisticas":[],"relevancias":[],"complecidades":[],"custos":[],"entregas":[],"segurancas":[],"atendimentos":[],"qualidades":[],"materiais":[],"maquinas":[],"mao_de_obra":[],"meio_ambientes":[],"metodos":[]});

        if (! this.$route.query.node) {
            this.$router.push({
                query: {node: this.tevep.nodes[0].id},
            });
        }
    },
}
</script>