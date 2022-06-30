<template>
    <div>
        <nuxt-layout name="default">
            <nuxt-link to="/auth">Login</nuxt-link>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: useAxios({
                url: '/api/app/search',
                params: {q:''},
                submit: true,
            }),
        };
    },
};
</script>