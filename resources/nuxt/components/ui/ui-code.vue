<template><div class="ui-code bg-dark">
  <prism-editor v-model="props.value" :highlight="highlighter" line-numbers @input="emit()"></prism-editor>
</div></template>

<style>
.ui-code .prism-editor__textarea:focus {outline: none;}
.ui-code .prism-editor__line-number {font-family:courier!important; color:#bbb!important;}
.ui-code .prism-editor__container * {font-family:courier!important;}
</style>


<script>
import { PrismEditor } from 'vue-prism-editor';
import 'vue-prism-editor/dist/prismeditor.min.css';

import { highlight, languages } from 'prismjs/components/prism-core';
import 'prismjs/components/prism-clike';
import 'prismjs/components/prism-javascript';
import 'prismjs/themes/prism-tomorrow.css';

export default {
  components: { PrismEditor },

  props: {
    value: {default:''},
    language: {default:'js'},
  },

  watch: {
    $props: {deep:true, handler(value) {
      this.props = Object.assign({}, value);
    }},
  },

  data() {
    let data = {};
    data.props = Object.assign({}, this.$props);
    return data;
  },

  methods: {
    highlighter(code) {
      let lang = languages[this.props.language]||languages.js;
      return highlight(code, lang);
    },

    emit() {
      this.$emit('input', this.props.value);
    },
  },
};
</script>
