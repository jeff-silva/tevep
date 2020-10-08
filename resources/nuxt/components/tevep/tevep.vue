<template><div class="tevep">
    <div v-for="t in tabs"  v-if="t.id==$route.query.tab">
        <div class="d-flex">

            <!-- Left -->
            <div class="bg-dark">
                <ul class="tevep-nav">
                    <li v-for="n in navs" :class="{active:compSlotBind.tabId==n.tab}">
                        <nuxt-link :to="{query:{node:compSlotBind.nodeId, tab:n.tab}}">
                            <img :src="n.icon" :alt="n.title" v-if="n.icon" style="width:100%;">
                            <span v-else>{{ n.title }}</span>
                        </nuxt-link>
                        <ul class="bg-dark" v-if="n.children.length>0">
                            <li v-for="nn in n.children" :class="{active:compSlotBind.tabId==nn.tab}">
                                <nuxt-link :to="{query:{node:compSlotBind.nodeId, tab:nn.tab}}">{{ nn.title }}</nuxt-link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Right -->
            <div class="flex-grow-1">
                <div class="bg-dark py-1">
                    <slot name="header" v-bind="compSlotBind"></slot>
                </div>

                <div class="p-2 shadow-sm font-weight-bold text-uppercase">{{ compSlotBind.tab.title }}</div>
                <div style="position:relative; overflow-x:auto; max-width:100%;">
                    <div class="p-2">
                        <slot :name="t.id" v-bind="compSlotBind">
                            <div class="bg-gray text-muted text-center p-3 m-0">{{ t.title }} em construção</div>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-dark p-2">
            <slot name="footer" v-bind="compSlotBind"></slot>
        </div>
    </div>

    <style>
    ul.tevep-nav {list-style-type:none; padding:0px; margin:0px; width:130px;}
    ul.tevep-nav > li {position:relative; height:100px; display:flex; align-items:center; justify-content:center; border:solid 1px transparent;}
    ul.tevep-nav > li > a {display:block; color:#fff!important; padding:10px; text-decoration:none!important;}
    ul.tevep-nav > li:hover {border-color:#ffffff66;}
    ul.tevep-nav > li:hover > a,
    ul.tevep-nav > li.active > a {}
    ul.tevep-nav > li > a > img {width:80px!important;}
    ul.tevep-nav > li > ul {list-style-type:none; padding:0px; margin:0px; position:absolute; top:0px; left:100%; width:200px; z-index:9; visibility:hidden; opacity:0; transition: all 300ms ease;}
    ul.tevep-nav > li:hover > ul,
    ul.tevep-nav > li > a:active ~ ul {visibility:visible; opacity:1;}
    ul.tevep-nav > li > ul > li {}
    ul.tevep-nav > li > ul > li > a {display:block; color:#fff; padding:5px; text-decoration:none!important;}
    ul.tevep-nav > li > ul > li:hover > a,
    ul.tevep-nav > li > ul > li.active > a {background:#fff; color:#444;}
    </style>

	<!--
	<div class="p-1" style="max-height:300px; overflow:auto;">
		<table class="table table-borderless table-sm m-0">
			<colgroup>
				<col width="150px">
				<col width="150px">
				<col width="50px">
				<col width="50px">
				<col width="*">
				<col width="*">
			</colgroup>
			<thead>
				<tr class="bg-dark text-white">
					<th>id</th>
					<th>parent</th>
					<th>order</th>
					<th>type</th>
					<th>title</th>
					<th>date_start</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="n in props.value.nodes">
					<td>{{ n.id }}</td>
					<td>{{ n.parent }}</td>
					<td>{{ n.order }}</td>
					<td>{{ n.type }}</td>
					<td class="p-0"><input type="text" class="form-control form-control-sm" v-model="n.title"></td>
					<td class="p-0"><input-datetime v-model="n.date_start" @input="emit()"></input-datetime></td>
				</tr>
			</tbody>
		</table>
	</div>
    <pre>compSlotBind.rut: {{ compSlotBind.rut }}</pre>
	<pre>compSlotBind: {{ compSlotBind }}</pre>
	<pre>$data: {{ $data }}</pre>
	-->
</div></template>

<script>
const moment = require('moment');

export default {
	props: {
		value: {default:()=>({})},
	},

	watch: {
		$props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},

        $route: {deep:true, handler(value) {
            let node = this.getNode({id:value.query.node});
            let children = this.getNodes({parent:node.id});
            if (children.length==0) {
                this.nodeAddChildren(node);
            }
        }},

		props: {deep:true, handler(value) {
            for(var i in value) {
                this.$emit(i, value[i]);
            }
        }},
	},

	computed: {
		compSlotBind() {
			let slotBind = {};

            let nodeId = this.$route.query.node||false;
            if (!nodeId && this.props?.value?.nodes) {
                nodeId = this.props.value.nodes[0].id;
            }


			slotBind.tabId = this.$route.query.tab;
			slotBind.nodeId = nodeId;
			slotBind.node = {};
			slotBind.nodeParent = {};
			slotBind.nodeChildren = [];
			
			if (slotBind.nodeId) {
				slotBind.node = this.getNode({id:slotBind.nodeId});
				slotBind.nodeParent = slotBind.node.parent? this.getNode({id:slotBind.node.parent}): {};
				slotBind.nodeChildren = this.getNodes({parent:slotBind.nodeId});
			}
			
			slotBind.nodeRoot = this.getNode({parent:''});			
			slotBind.rut = this.getRut();
			slotBind.tevep = this.props.value;
            slotBind.tabs = this.tabs;
            
            slotBind.tab = {};
            if (slotBind.tabId) {
                this.tabs.forEach((tab) => {
                    if (tab.id==slotBind.tabId) {
                        slotBind.tab = tab;
                    }
                })
            }

            slotBind.error = this.error;

			// Methods
			slotBind.nodeAdd = this.nodeAdd;
			slotBind.nodeGoto = this.nodeGoto;
			slotBind.tevepSave = this.tevepSave;
			slotBind.getNode = this.getNode;
			slotBind.getNodes = this.getNodes;
			slotBind.emit = this.emit;

			return slotBind;
		},
	},

	methods: {
		uuid(prefix='node', format='xxxxxxxxxx') {
			return prefix+format.replace(/[xy]/g, function(c) {
				var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			});
		},

		emit() {
			this.$emit('input', this.props.value);
			// this.$emit('change', this.compSlotBind);
		},

		tevepDefault(merge={}) {
			return Object.assign({
				id: '',
                user_id: '',
				title: '',
				divisor: 'days',
				nodes: [],
				date_start: '',
				date_final: '',
			}, merge||{});
		},

		tevepSave() {
            this.error = {};
            console.log(this.$user());
            this.props.value.user_id = this.$user('id');
			this.$axios.post('/api/teveps/save/', this.props.value).then((resp) => {
                if (resp.data.error) {
                    this.error = resp.data.error;
                }

                if (resp.data.id) {
                    this.$router.push({
                        path: `/tevep/${resp.data.id}/`,
                        query: this.$route.query,
                    });
                    this.$swalSuccess('Projeto salvo');
                }
            });
		},

		nodeDefault(merge={}) {
			return Object.assign({}, {
				id: this.uuid(),
				title: "",
				parent: '',
				level: 0,
				type: '',
				order: 0,
				date_start: "",
				date_final: "",
				utilities: [],
				inherences: [],
				expectations: [],
				innovations: [],
				logistics: [],
				relevance: [],
				complexity: [],
				costs: [],
				delivery: [],
				safety: [],
				attendance: [],
				quality: [],
				machine: [],
				material: [],
				labor: [],
				environment: [],
				methods: [],
			}, merge||{});
		},

		nodeAdd(node={}, addChildren=true) {
			node = this.nodeDefault(node);
			this.props.value.nodes.push(node);
			if (addChildren) { this.nodeAddChildren(node); }
            this.$emit('input', this.props.value);
			return node;
		},

        nodeAddChildren(node) {
            let level = 1+(node.level||0);
            for(let i=0; i<7; i++) {
                this.nodeAdd({
                    id: this.uuid(),
                    parent: node.id,
                    level: level,
                    title:`T${i+1}`,
                    date_start: '',
                    type: 'time',
                    order: i,
                }, false);

                this.nodeAdd({
                    id: this.uuid(),
                    parent: node.id,
                    level: level,
                    title:`E${i+1}`,
                    date_start: '',
                    type: 'space',
                    order: i,
                }, false);

                this.nodeAdd({
                    id: this.uuid(),
                    parent: node.id,
                    level: level,
                    title:'',
                    date_start: '',
                    type: 'user',
                    order: i,
                }, false);

                this.nodeAdd({
                    id: this.uuid(),
                    parent: node.id,
                    level: level,
                    title:'',
                    date_start: '',
                    type: 'target',
                    order: i,
                }, false);
            }
        },

        nodeGoto(nodeId) {
            this.$router.push({
                query: {
                    node: nodeId,
                    tab: this.$route.query.tab,
                },
            });

            // setTimeout(() => {
            //     let nodeId = this.$route.query.node;
            //     console.log(nodeId, this.props.value.nodes);
            //     let children = this.getNodes({parent:nodeId});
            //     if (children.length==0) {
            //         let node = this.getNode({id:nodeId});
            //         // this.nodeAddChildren(node);
            //     }
            // }, 0);
        },

		getNodes(params={}) {
			let nodes = this.props.value.nodes||[];

            ['id', 'parent', 'type'].forEach((kkey) => {
                if (params[kkey]) {
                    nodes = nodes.filter((node) => {
                        return node[kkey]==params[kkey];
                    });
                }
            });

			return nodes;
		},

		getNode(params={}) {
			let nodes = this.getNodes(params);
			return nodes[0]? nodes[0]: {};
		},

        getRut() {
            let rut = {};

            let node = this.getNode({id:this.$route.query.node});

            rut.date_start = node.date_start;
            rut.date_final = node.date_final;

            rut.items = this.getNodes({type:"time", parent:node.id});

            rut.items = rut.items.filter((item) => {
                return !!item.date_start;
            });
            
            let date_start = moment(rut.date_start);
            let date_final = moment(rut.date_final);
            let getPercent = function(d, start=false, final=false) {
                start = start? moment(start): date_start;
                final = final? moment(final): date_final;

                let percent = (moment(d) - start) / (final - start) * 100;
                return (Math.round(percent * 100) / 100);
            };

            rut.items = rut.items.map((node, index) => {
                let item = {};
                item.date_start = node.date_start||'';
                item.date_final = (rut.items[index+1]? rut.items[index+1].date_start: rut.date_final);
                item.percent = getPercent(item.date_start);
                item.duration = getPercent(item.date_final);
                item.node = node;

                return item;
            });

            rut.items = rut.items.sort((a, b) => {
                if (a.percent>b.percent) return 1;
                else if (a.percent<b.percent) return -1;
                return 0;
            });

            return rut;
        },


        tevepPopulate() {
            // 
        },


        tevepInit(tevep={}) {

            if (!tevep.id) {
                tevep = this.tevepDefault(tevep);
            }

            this.$set(this.props, 'value', tevep);

            if (this.props.value.nodes.length==0) {
                this.nodeAdd({}, true);
            }

            this.$emit('init', this.compSlotBind);

            this.$router.push({
                path: `/tevep/${tevep.id||0}/`,
                query: {
                    node: this.props.value.nodes[0].id,
                    tab: (this.$route.query.tab||this.tabs[0].id),
                },
            });
        },
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
            error: {},
			tabs: [
				{id: "principios", title: "Princípios"},

				// Fundamentos
				{id: "utilidade", title: "Utilidade"},
				{id: "inerencias", title: "Inerências"},
				{id: "expectativas", title: "Expectativas"},
				{id: "inovacoes", title: "Inovações"},
				{id: "logistica", title: "Logística"},
				{id: "relevancia", title: "Relevância"},
				{id: "complexidade", title: "Complexidade"},

				// CESAQ
				{id: "custo", title: "Custo"},
				{id: "entrega", title: "Entrega"},
				{id: "seguranca", title: "Segurança"},
				{id: "atendimento", title: "Atendimento"},
				{id: "qualidade", title: "Qualidade"},

				// Flor
				{id: "material", title: "Material"},
				{id: "maquina", title: "Máquina"},
				{id: "mao-de-obra", title: "Mão de obra"},
				{id: "meio-ambiente", title: "Meio ambiente"},
				{id: "metodo", title: "Método"},

				// RUT
				{id: "rut", title: "RUT"},
            ],
            
            navs: [
                {title:"Princípios", tab:"principios", icon:false, children:[]},
                {title:"Fundamentos", tab:"utilidade", icon:false, children:[
                    {title:"Utilidade", tab:"utilidade", icon:false, children:[]},
                    {title:"Inerências", tab:"inerencias", icon:false, children:[]},
                    {title:"Expectativas", tab:"expectativas", icon:false, children:[]},
                    {title:"Inovações", tab:"inovacoes", icon:false, children:[]},
                    {title:"Logística", tab:"logistica", icon:false, children:[]},
                    {title:"Relevância", tab:"relevancia", icon:false, children:[]},
                    {title:"Complexidade", tab:"complexidade", icon:false, children:[]},
                ]},
                {title:"CESAQ", tab:"custo", icon:require("~/assets/icons/estrela.png"), children:[
                    {title:"Custo", tab:"custo", icon:false, children:[]},
                    {title:"Entrega", tab:"entrega", icon:false, children:[]},
                    {title:"Segurança", tab:"seguranca", icon:false, children:[]},
                    {title:"Atendimento", tab:"atendimento", icon:false, children:[]},
                    {title:"Qualidade", tab:"qualidade", icon:false, children:[]},
                ]},
                {title:"5S", tab:"material", icon:require("~/assets/icons/flor.png"), children:[
                    {title:"Material", tab:"material", icon:false, children:[]},
                    {title:"Máquina", tab:"maquina", icon:false, children:[]},
                    {title:"Mão de obra", tab:"mao-de-obra", icon:false, children:[]},
                    {title:"Meio ambiente", tab:"meio-ambiente", icon:false, children:[]},
                    {title:"Método", tab:"metodo", icon:false, children:[]},
                ]},
                {title:"RUT", tab:"rut", icon:require("~/assets/icons/rut.png"), children:[]},
            ],
		};
	},

	mounted() {
        this.$axios.get('/api/teveps/find', {params:{id:this.$route.params.id}}).then((resp) => {
            let tevep = resp.data.id? resp.data: {};
            tevep.id = tevep.id||0;
            this.tevepInit(tevep);
        });
	},
};</script>