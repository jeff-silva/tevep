<template>
  <nuxt-page></nuxt-page>
</template>

<script>
export default {
  data() {
    return {
      app: useApp(),
    };
  },

  mounted() {
    document.head.append(Object.assign(document.createElement('link'), {
      rel: 'icon',
      type: 'image/x-icon',
      href: this.app.settings['app.icon']
    }));
  },
};
</script>