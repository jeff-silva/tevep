<template>
    <a href="javascript:;" @click="logout()">
        <slot></slot>
    </a>
</template>

<script>
export default {
    props: {
        redirect: {value:""},
    },

    methods: {
        logout() {
            this.$auth.logout().then(resp => {
                // if (this.redirect) {
                //     this.$router.push(this.redirect);
                //     return;
                // }

                location.reload();
            });
        },
    },
}
</script>