<template>
    <div>
        <nuxt-layout name="admin">
            Admin
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    mounted() {
        useApp().setTitle('Dashboard');
    },
};
</script>