<template><div class="tevep-tab">

    <div class="bg-white shadow-sm m-2 p-2" v-if="loading"><i class="fas fa-spin fa-spinner"></i> Carregando</div>

    <div v-else>
        <div class="bg-white shadow-sm m-2 p-2" v-if="$route.params.id!=0 && !tevep.id">
            <div>Este projeto não existe.</div>
            <nuxt-link to="/tevep/">Voltar</nuxt-link>
        </div>

        <ui-form method="post" action="/api/tevep/store/" v-model="tevep" @success="success($event)" v-else>
            <div class="d-flex" style="overflow:auto;">
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
                    <div style="height:calc(100vh - 110px); min-width:1000px; overflow:auto;">

                        <!-- if empty -->
                        <div class="text-muted p-2" v-if="$route.matched.length==1">
                            <principios v-bind.sync="compBind"></principios>
                        </div>

                        <nuxt-child class="p-1" v-bind.sync="compBind"></nuxt-child>

                        <!-- <pre>$store.state.tevep: {{ $store.state.tevep }}</pre> -->
                        <!-- <pre>compBind.tevep: {{ compBind.tevep }}</pre> -->
                    </div>
                </div>
            </div>

            <ui-actions>
                <nuxt-link class="btn btn-link" to="/tevep/">Voltar</nuxt-link>

                <button type="submit" class="btn btn-primary">
                    Salvar
                </button>
            </ui-actions>
        </ui-form>
    </div>
</div></template>

<style>
.tevep-tab {margin:-30px 0px 0px -30px;}
.tevep-tab .alert {margin:0px;}

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
import Principios from '@/pages/tevep/_id/_tab/principios.vue';

export default {
    layout: 'admin',
    middleware: 'auth',
    components: {Principios},

    data() {
        return {
            loading: false,
            tevep: this.tevepDefault(),
        };
    },

    methods: {
        success(tevep) {
            this.$swal('Sucesso', 'Dados salvos', 'success');
            this.$router.push({
                path: this.$route.path.replace('/0/', `/${tevep.id}/`),
                query: {node:this.$route.query.node},
            });
        },

        uuid(prefix='', format='xxxxxxxxxx') {
			return prefix+format.replace(/[xy]/g, function(c) {
				var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			});
		},

        tevepInit(tevep={}) {
            this.$set(this, 'tevep', this.tevepDefault(tevep));

            let query = Object.assign({}, this.$route.query);
            if (! query.node) { query.node = this.tevep.nodes[0].id; }
            this.$router.push({ query });

            // Verify pingpong query
            if (query.pingpong) {
                this.$axios.post(`/api/tevep/${this.tevep.id}/pingpong-confirm/${query.pingpong}`).then(resp2 => {
                    delete query.pingpong;
                    this.$router.push({ query });
                    this.tevep = this.tevepDefault(resp2.data||{});
                });
            }
        },

        tevepLoad(loading=true) {
            if (0==this.$route.params.id) {
                this.tevepInit();
                return;
            }

            this.loading = loading;
            this.$axios.get(`/api/tevep/find/${this.$route.params.id}`).then(resp => {
                this.loading = false;
                this.tevepInit(resp.data||{});
            });
        },

        tevepTitle(node) {
            if (node.parent) return;
            this.tevep.title = node.title;
            this.tevep.date_start = node.date_start;
            this.tevep.date_final = node.date_final;
        },

        tevepDefault(tevep={}) {
            tevep = Object.assign({
                user_id: this.$auth.user.id,
                title: "",
                date_start: "",
                date_final: "",
                nodes: [],
                pingpongs: [],
            }, tevep);

            tevep.user_id = tevep.user_id || this.$auth.user.id;

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
                id: this.uuid('pingpong-'),
                from: this.$auth.user.id,
                to: false,
                nodeId: this.$route.query.node,
                notificationsSent: 0,
                accepted: false,
            }, pingpong);

            return pingpong;
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
            
            // Todos os metodos
            for(let m in this.$options.methods) {
                data[m] = this.$options.methods[m];
            }

            return data;
        },

        compNavItems() {
            return [
                {
                    title: "Princípios",
                    icon: false,
                    to: {path:`/tevep/${this.$route.params.id}/principios/`, query:this.$route.query},
                    children: [],
                },
                {
                    title: "Fundamentos",
                    icon: false,
                    to: {path:`/tevep/${this.$route.params.id}/utilidades/`, query:this.$route.query},
                    children: [
                        {
                            title: "Utilidades",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/utilidades/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Inerências",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/inerencias/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Expectativas",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/expectativas/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Inovações",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/inovacoes/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Logística",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/logistica/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Relevância",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/relevancia/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Complexidade",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/complexidade/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "Cesaq",
                    icon: require('@/assets/icons/estrela.png'),
                    to: {path:`/tevep/${this.$route.params.id}/custo/`, query:this.$route.query},
                    children: [
                        {
                            title: "Custo",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/custo/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Entrega",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/entrega/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Segurança",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/seguranca/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Atendimento",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/atendimento/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Qualidade",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/qualidade/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "Material",
                    icon: require('@/assets/icons/flor.png'),
                    to: {path:`/tevep/${this.$route.params.id}/material/`, query:this.$route.query},
                    children: [
                        {
                            title: "Material",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/material/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Máquina",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/maquina/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Mão de obra",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/mao-de-obra/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Meio ambiente",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/meio-ambiente/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Método",
                            icon: false,
                            to: {path:`/tevep/${this.$route.params.id}/metodo/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "RUT",
                    icon: require('@/assets/icons/rut.png'),
                    to: {path:`/tevep/${this.$route.params.id}/rut/`, query:this.$route.query},
                    children: [],
                },
            ];
        },
    },

    mounted() {
        // this.tevep = this.tevepDefault({"title":"Teste","date_start":"2021-01-01 00:00:00","date_final":"2021-01-31 00:00:00","nodes":[{"id":"node-7480fc397c","parent":false,"title":"Teste","level":0,"date_start":"2021-01-01 00:00:00","date_final":"2021-01-31 00:00:00","tempos":[{"title":"T1","date_start":"","date_final":""},{"title":"T2","date_start":"","date_final":""},{"title":"T3","date_start":"","date_final":""},{"title":"T4","date_start":"","date_final":""},{"title":"T5","date_start":"","date_final":""},{"title":"T6","date_start":"","date_final":""},{"title":"T7","date_start":"","date_final":""}],"piloto":"Fulano","pilotos":[],"pessoa":"Sicrano","pessoas":[],"espaco":"Local 1","espacos":[],"utilidades":[],"inerencias":[],"expectativas":[],"inovacoes":[],"logisticas":[],"relevancias":[],"complecidades":[],"custos":[],"entregas":[],"segurancas":[],"atendimentos":[],"qualidades":[],"materiais":[],"maquinas":[],"mao_de_obra":[],"meio_ambientes":[],"metodos":[]}],"pingpongs":[]});
        // http://192.168.56.1:3000/tevep/5/?pingpong=pingpong-602f0f5eb80b5

        this.tevepLoad();
    },
}
</script>