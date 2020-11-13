<template><div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="mb-3 bg-white p-2 pb-0 shadow-sm">
                <div class="d-flex align-items-center mb-2" v-for="n in $store.state.notifications.items" :key="n.id">
                    <div><div :style="`width:40px; height:40px; background:url(${n.image}) center center no-repeat; background-size:cover;`"></div></div>
                    <div class="flex-grow-1 pl-3" v-html="n.title"></div>
                    <div><nuxt-link :to="`/user/notifications/${n.id}/`" @click="notificationsRead(n)">goto</nuxt-link></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8" v-if="$route.params.id">
            <div v-for="n in $store.state.notifications.items" :key="n.id" v-if="n.id==$route.params.id">
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
            this.$axios.post(`/api/user/notification/${notif.id}/`).then(resp => {
                console.log(resp);
            });
        },
    },

    data() {
        return {
            notifications: [],
        };
    },
}
</script>
