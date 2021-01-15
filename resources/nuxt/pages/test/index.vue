<template><div>
    <div class="row no-gutters">
        <div class="col-2">
            <div class="nav nav-pills flex-column">
                <nuxt-link to="/test" class="nav-link">Home</nuxt-link>
                <nuxt-link to="/test" class="nav-link">Endpoints</nuxt-link>
                <nuxt-link to="/test" class="nav-link">Data generator</nuxt-link>
            </div>
        </div>
        <div class="col">

            <div class="p-1">
                <ui-table :items="tableItems" :select="true" v-model="tableSelecteds">
                    <template #header="{items}">
                        <th width="10px">ID</th>
                        <th width="50%">Descrição</th>
                        <th>Status</th>
                    </template>

                    <template #item="{item}">
                        <td>{{ item.id }}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.completed? 'Completo': '' }}</td>
                    </template>

                    <template #actions="{item}">
                        <a href="" class="btn btn-primary"><i class="fa fa-fw fa-upload"></i></a>
                        <a href="" class="btn btn-primary"><i class="fa fa-fw fa-download"></i></a>
                    </template>

                    <template #empty>
                        Nenhum item encontrado
                    </template>
                </ui-table>

                <ui-table :items="tableSelecteds" :select="false">
                    <template #header="{items}">
                        <th width="10px">ID</th>
                        <th width="50%">Descrição</th>
                        <th>Status</th>
                    </template>

                    <template #item="{item}">
                        <td>{{ item.id }}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.completed? 'Completo': '' }}</td>
                    </template>

                    <template #actions="{item}">
                        <a href="" class="btn btn-primary"><i class="fa fa-fw fa-upload"></i></a>
                        <a href="" class="btn btn-primary"><i class="fa fa-fw fa-download"></i></a>
                    </template>

                    <template #empty>
                        Nenhum item encontrado
                    </template>
                </ui-table>
            </div>
            
            <div class="row no-gutters">
                <div class="col-6">
                    <ui-carousel v-model="carouselIndex">
                        <template #sliders>
                            <div v-for="n in 10" style="width:100%;">
                                <img :src="'https://source.unsplash.com/random/200x200/?r='+n" alt="" width="100%">
                            </div>
                        </template>
                    </ui-carousel>
                </div>

                <div class="col-6">
                    <ui-carousel v-model="carouselIndex">
                        <template #sliders>
                            <div v-for="n in 10" style="width:100%;">
                                <img :src="'https://source.unsplash.com/random/200x200/?r='+n" alt="" width="100%">
                            </div>
                        </template>
                    </ui-carousel>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 bg-primary mb-4 text-white">
                    <div class="d-flex p-3" v-if="$store.$auth.user">
                        <div class="flex-grow-1">{{ $store.$auth.user.name }} - {{ $store.$auth.user.email }}</div>
                        <div><a href="javascript:;" @click="$auth.logout()" class="text-white">Sair</a></div>
                    </div>

                    <div class="p-3" v-else>Deslogado</div>
                </div>
                <div class="col-6 col-md-4">
                    <ui-auth-login></ui-auth-login>                    
                </div>
                <div class="col-6 col-md-4">
                    <ui-auth-register></ui-auth-register>
                </div>
                <div class="col-12 col-md-4">
                    <ui-auth-password></ui-auth-password>
                </div>
            </div>

            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>Método</th>
                        <th>Endpoint</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="e in endpoints">
                        <td>{{ e.methods.join(' / ') }}</td>
                        <td>{{ e.uri }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            endpoints: [],
            carouselIndex: 0,
            tableItems: [],
            tableSelecteds: [],
        }
    },

    mounted() {
        this.$axios.get('/api/').then((resp) => {
            this.endpoints = resp.data;
        });

        this.$axios.get('https://jsonplaceholder.typicode.com/todos').then(resp => {
            this.tableItems = resp.data;
        });
    },
}
</script>