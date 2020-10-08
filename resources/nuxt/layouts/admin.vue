<script>
import User from '@/models/User';

export default {
    methods: {
        logout() {
            this.$store.dispatch('auth/logout').then((resp) => {
                this.$router.push('/auth');
            });
        },
    },

    data() {
        return {
            profileOpen: false,
            sidebarOpen: false,
            sidebarItems: [
                {to:"/dashboard", title:"Dashboard", icon:"fa fa-home", children:[]},
                {to:"", title:"Tevep", icon:"fa fa-shopping-bag", children:[
                    {to:"/tevep", title:"Projetos", icon:"fa fa-shopping-bag", children:[]},
                    {to:"/tevep/0", title:"Novo", icon:"fa fa-shopping-bag", children:[]},
                ]},
                {to:"/user/settings/", title:"Configurações", icon:"fa fa-cog", children:[]},
            ],
        };
    },

    mounted() {
        this.$store.dispatch('auth/me');
    },
};</script>


<!-- https://modularcode.io/modular-admin-html/ -->
<template><div>
    <div class="main-wrapper">
        <div id="app" class="app" :class="{'sidebar-open':sidebarOpen}">
            
            <!--
            <div class="d-flex align-items-center bg-white shadow p-1">
                <div class="flex-grow-1">Aaa</div>
                <div class="">
                    <ui-btn-dropdown :right="true">
                        <template #dropdown>
                            <div class="profile-sidebar bg-white shadow-sm px-2 py-2" style="width:160px;">
                                <div class="text-center mb-2">
                                    <img :src="$store.state.auth.user.photo" alt="" style="width:90%; border-radius:5px;">
                                </div>

                                <div class="text-center font-weight-bold text-uppercase">
                                    {{ $store.state.auth.user.name }}
                                </div>

                                <div class="list-group">
                                    <nuxt-link class="list-group-item border-0 p-2" to="/">Aaa</nuxt-link>
                                    <nuxt-link class="list-group-item border-0 p-2" to="/">Aaa</nuxt-link>
                                    <nuxt-link class="list-group-item border-0 p-2" to="/">Aaa</nuxt-link>
                                </div>
                            </div>
                        </template>
                    </ui-btn-dropdown>
                </div>
            </div>
            -->

            <header class="header">
                <div class="header-block header-block-collapse d-lg-none d-xl-none">
                    <button class="collapse-btn" id="sidebar-collapse-btn" @click="sidebarOpen=true">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <div class="header-block header-block-search">
                    <form role="search">
                        <div class="input-container">
                            <i class="fa fa-search"></i>
                            <input type="search" placeholder="Buscar">
                            <div class="underline"></div>
                        </div>
                    </form>
                </div>
                
                <!-- <div class="header-block header-block-buttons">
                    <a href="https://github.com/modularcode/modular-admin-html" class="btn btn-sm header-btn">
                        <i class="fa fa-github-alt"></i>
                        <span>View on GitHub</span>
                    </a>
                </div> -->

                <div class="header-block header-block-nav">
                    <ul class="nav-profile">
                        <!--
                        <li class="notifications new">
                            <a href="" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <sup>
                                    <span class="counter">8</span>
                                </sup>
                            </a>
                            <div class="dropdown-menu notifications-dropdown-menu">
                                <ul class="notifications-container">
                                    <li>
                                        <a href="" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('assets/faces/3.jpg')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Zack Alien</span> pushed new commit: <span class="accent">Fix page load performance issue</span>. </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('assets/faces/5.jpg')"></div>
                                                </div>
                                                <div class="body-col">
                                                    <p>
                                                        <span class="accent">Amaya Hatsumi</span> started new task: <span class="accent">Dashboard UI design.</span>. </p>
                                                    </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('assets/faces/8.jpg')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Andy Nouman</span> deployed new version of <span class="accent">NodeJS REST Api V3</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <footer>
                                    <ul>
                                        <li>
                                            <a href=""> View All </a>
                                        </li>
                                    </ul>
                                </footer>
                            </div>
                        </li>
                        -->

                        <li class="profile dropdown" :class="{show:profileOpen}">
                            <a class="nav-link dropdown-toggle" href="javascript:;" @click="profileOpen=!profileOpen">
                                <div class="img" :style="`background-image: url(${$store.state.auth.user.photo})`"></div>
                                <span class="name"> {{ $store.state.auth.user.name }} </span>
                            </a>
                            <div class="dropdown-menu profile-dropdown-menu" :class="{show:profileOpen}">
                                <nuxt-link to="/user/" class="dropdown-item" @click.native="profileOpen=false">
                                    <i class="fa fa-user icon"></i> Profile
                                </nuxt-link>
                                <nuxt-link to="/user/notifications/" class="dropdown-item" @click.native="profileOpen=false">
                                    <i class="fa fa-bell icon"></i> Notifications
                                </nuxt-link>
                                <nuxt-link to="/user/settings/" class="dropdown-item" @click.native="profileOpen=false">
                                    <i class="fa fa-gear icon"></i> Configurações
                                </nuxt-link>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:;" class="dropdown-item" @click="logout()">
                                    <i class="fa fa-power-off icon"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
            <aside class="sidebar">
                <div class="sidebar-container">
                    <div class="sidebar-header">
                        <div class="brand">
                            Modular Admin
                        </div>
                    </div>
                    <nav class="menu">
                        <ul class="sidebar-menu metismenu" id="sidebar-menu">
                            <li class="" v-for="i in sidebarItems" :class="{open:!!i.open}">
                                <a href="javascript:;" v-if="i.children.length>0" @click="$set(i, 'open', !i.open)">
                                    <i :class="i.icon"></i> {{ i.title }}
                                    <i class="fa arrow"></i>
                                </a>

                                <nuxt-link :to="i.to" v-if="i.children.length==0" @click.native="sidebarOpen=false">
                                    <i :class="i.icon"></i> {{ i.title }}
                                </nuxt-link>

                                <ul class="sidebar-nav collapse" v-if="i.children.length>0" :style="i.open? `height:auto; display:block;`: `height:0px;`">
                                    <li v-for="ii in i.children">
                                        <nuxt-link :to="ii.to" @click.native="sidebarOpen=false"> {{ ii.title }} </nuxt-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <footer class="sidebar-footer">
                    <ul class="sidebar-menu metismenu" id="customize-menu">
                        <li>
                            <ul class="collapse">
                                <li class="customize">
                                    <div class="customize-item">
                                        <div class="row customize-header">
                                            <div class="col-4">
                                            </div>
                                            <div class="col-4">
                                                <label class="title">fixed</label>
                                            </div>
                                            <div class="col-4">
                                                <label class="title">static</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="title">Sidebar:</label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                    <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                    <input class="radio" type="radio" name="sidebarPosition" value="">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="title">Header:</label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                    <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                    <input class="radio" type="radio" name="headerPosition" value="">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="title">Footer:</label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                    <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                    <input class="radio" type="radio" name="footerPosition" value="">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="customize-item">
                                        <ul class="customize-colors">
                                            <li>
                                                <span class="color-item color-red" data-theme="red"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-orange" data-theme="orange"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-green" data-theme=""></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-seagreen" data-theme="seagreen"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-blue" data-theme="blue"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-purple" data-theme="purple"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <a href="">
                                <i class="fa fa-cog"></i> Customize </a>
                        </li>
                    </ul>
                </footer>
            </aside>
            <div class="sidebar-overlay" id="sidebar-overlay" @click="sidebarOpen=false"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>
            
            <div class="d-none d-md-block" style="height:70px;"></div>
            <div class="d-block d-md-none" style="height:50px;"></div>

            <article class="dashboard-page p-3">
                <nuxt />
            </article>

            <br>
            <footer class="footer">
                <div class="footer-block buttons">
                    &nbsp;
                </div>
                <div class="footer-block author">
                    <ul>
                        <li><a href="https://jsiqueira.com">jsiqueira.com</a></li>
                    </ul>
                </div>
            </footer>
            <div class="modal fade" id="modal-media">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Media Library</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                        <div class="modal-body modal-tab-container">
                            <ul class="nav nav-tabs modal-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a>
                                </li>
                            </ul>
                            <div class="tab-content modal-tab-content">
                                <div class="tab-pane fade" id="gallery" role="tabpanel">
                                    <div class="images-container">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                    <div class="upload-container">
                                        <div id="dropzone">
                                            <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                <div class="dz-message-block">
                                                    <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Insert Selected</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" id="confirm-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure want to do this?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
    <!-- Reference block for JS -->
    <div class="ref" id="ref">
        <div class="color-primary"></div>
        <div class="chart">
            <div class="color-primary"></div>
            <div class="color-secondary"></div>
        </div>
    </div>
</div></template>
