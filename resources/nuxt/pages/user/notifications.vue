<template><div>
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="bg-white shadow-sm">
                <div class="d-flex align-items-center p-1" v-for="n in notifications.resp.data" :key="n.id" :class="{'bg-gray-100':n.id==$route.params.id}">
                    <div><div :style="`width:40px; height:40px; background:url(${n.image}) center center no-repeat; background-size:cover;`"></div></div>
                    <div class="flex-grow-1 px-2" v-html="n.title"></div>
                    <div><nuxt-link :to="`/user/notifications/${n.id}/`" class="btn btn-primary btn-sm" @click="notificationsRead(n)">
                        <i class="fas fa-caret-right"></i>
                    </nuxt-link></div>
                </div>
                <div class="p-1">
                    <ui-laravel-pagination v-model="notifications.resp" @change="notifications.params.page=$event.page; notificationsLoad();"></ui-laravel-pagination>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div v-for="n in notifications.resp.data" :key="n.id" v-if="n.id==$route.params.id">
                <nuxt-child :value="n" class="p-3 bg-white shadow-sm" keep-alive></nuxt-child>
            </div>
        </div>
    </div>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    methods: {
        notificationsRead(notif) {
            notif.seen = 1;
            this.$axios.post(`/api/user/notification/${notif.id}/`);
        },

        notificationsLoad() {
            this.notifications.loading = true;
            this.$axios.get('/api/user/notifications/', {params:this.notifications.params}).then(resp => {
                this.notifications.resp = resp.data;
                this.notifications.loading = false;
            });
        },
    },

    data() {
        return {
            notifications: {
                loading: false,
                params: {seen:null, perpage:10, page:1},
                resp: {},
            },
        };
    },

    mounted() {
        this.notificationsLoad();
    },
}
</script>
