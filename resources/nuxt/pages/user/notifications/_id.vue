<template><div>
    <h3 class="h5">{{ value.title }}</h3>
    <div v-html="value.body"></div>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    props: {
        value: {default:()=>({})},
    },

    methods: {
        notificationsRead(notif) {
            this.$axios.post(`/api/user/notification/${notif.id}/`).then(resp => { });
        },
    },

    mounted() {
        this.notificationsRead(this.value);
    },
}
</script>
