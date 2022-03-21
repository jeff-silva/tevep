<template>
    <div>
        <div class="d-flex">
            <div class="bg-dark" style="height:100vh; width:200px;">
                <ui-nav :items="navItems" text-color="#fff"></ui-nav>
            </div>
    
            <div class="flex-grow-1 p-3" style="height:100vh; overflow:auto;">
                <nuxt-child></nuxt-child>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    middleware: ['auth'],

    data() {
        return {
            navItems: this.getComponents(),
        };
    },

    methods: {
        getComponents() {
            let files = require.context('./index', true, /\.vue$/);
            return files.keys().map(key => {
                let item = files(key).default.head();
                item.label = item.title;
                delete item.title;
                item.to = `/admin/dev/${key}`.replace(/(\.\/)|(\.vue)|(index)/g, '');
                return item;
            });
        },
    },
}
</script>