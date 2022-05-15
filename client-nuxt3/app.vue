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

  methods: {
    faviconInit() {
      document.head.append(Object.assign(document.createElement('link'), {
        rel: 'icon',
        type: 'image/x-icon',
        href: this.app.settings['app.icon']
      }));
    },

    analyticsInit() {
      if (!this.app.settings['google.ga4.id']) return;
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', this.app.settings['google.ga4.id']);
    },
  },

  mounted() {
    this.faviconInit();
    this.analyticsInit();
  },
};
</script>