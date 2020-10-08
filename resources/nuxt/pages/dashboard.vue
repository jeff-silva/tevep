<template><div>
    <div class="container">
        Bem vindo.
    </div>
</div></template>

<script>export default {
    layout: 'admin',
    middleware: 'auth',

    components: {
        // "ui-navbar": () => import("@/components/ui/ui-navbar"),
    },

    data() {
        return {};
    },
};</script>