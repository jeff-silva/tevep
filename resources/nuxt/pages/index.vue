<!-- Clone from auth/index.vue -->

<template><div>
    <PageAuthIndex></PageAuthIndex>
</div></template>

<script>
import PageAuthIndex from './auth/index.vue';

export default {
    layout: 'auth',
    components: { PageAuthIndex },
};
</script>