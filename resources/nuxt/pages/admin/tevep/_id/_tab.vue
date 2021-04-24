<template><div class="tevep-tab">
    <div class="d-flex">
        <div class="bg-dark">
            <ul class="tevep-nav">
                <li v-for="i in navItems">
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
        <div class="flex-grow-1 p-2">
            <nuxt-child></nuxt-child>
        </div>
    </div>
</div></template>

<style>
.tevep-tab {margin:-30px -30px 0px -30px;}
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
export default {
    computed: {
        navItems() {
            return [
                {
                    title: "Princípios",
                    icon: false,
                    to: {path:`/admin/tevep/${this.$route.params.id}/principios/`, query:this.$route.query},
                    children: [],
                },
                {
                    title: "Fundamentos",
                    icon: false,
                    to: {path:`/admin/tevep/${this.$route.params.id}/utilidades/`, query:this.$route.query},
                    children: [
                        {
                            title: "Utilidades",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/utilidades/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Inerências",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/inerencias/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Expectativas",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/expectativas/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Inovações",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/inovacoes/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Logística",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/logistica/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Relevância",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/relevancia/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Complexidade",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/complexidade/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "Cesaq",
                    icon: require('@/assets/icons/estrela.png'),
                    to: {path:`/admin/tevep/${this.$route.params.id}/custo/`, query:this.$route.query},
                    children: [
                        {
                            title: "Custo",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/custo/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Entrega",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/entrega/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Segurança",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/seguranca/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Atendimento",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/atendimento/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Qualidade",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/qualidade/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "Material",
                    icon: require('@/assets/icons/flor.png'),
                    to: {path:`/admin/tevep/${this.$route.params.id}/material/`, query:this.$route.query},
                    children: [
                        {
                            title: "Material",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/material/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Máquina",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/maquina/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Mão de obra",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/mao-de-obra/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Meio ambiente",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/meio-ambiente/`, query:this.$route.query},
                            children: [],
                        },
                        {
                            title: "Método",
                            icon: false,
                            to: {path:`/admin/tevep/${this.$route.params.id}/metodo/`, query:this.$route.query},
                            children: [],
                        },
                    ],
                },
                {
                    title: "RUT",
                    icon: require('@/assets/icons/rut.png'),
                    to: {path:`/admin/tevep/${this.$route.params.id}/rut/`, query:this.$route.query},
                    children: [],
                },
            ];
        },
    },
}
</script>