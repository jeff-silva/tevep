<template><div class="ui-color form-control input-group p-0 border-0" style="position:relative;">
  <input type="text" class="form-control" v-model="props.value">
  <component class="ui-color-component" :is="props.type" v-model="tempValue" @input="emit(tempValue)" style="position:absolute; top:100%; left:0px; z-index:2;"></component>
  <div class="input-group-prepend"><div class="input-group-text" :style="`background:${props.value};`">&nbsp;</div></div>
</div></template>


<style>
.ui-color .ui-color-component {visibility:hidden; opacity:0; height:0px; overflow:hidden; transition: all 300ms ease;}
.ui-color:hover .ui-color-component,
.ui-color > .form-control:focus + .ui-color-component {visibility:visible; opacity:1; height:auto;}
</style>


<script>
import { Compact, Sketch, Chrome, Photoshop } from 'vue-color';

export default {
  components: { Compact, Sketch, Chrome, Photoshop },

  props: {
    value: {default:''},
    type: {default:'chrome'},
    show: {default:false},
  },

  watch: {
    $props: {deep:true, handler(value) {
      this.props = Object.assign({}, value);
    }},
  },

  methods: {
    emit(value) {
      this.props.value = value.hex8;
      this.$emit('input', this.props.value);
    },
  },

  data() {
    let data = {};
    data.props = Object.assign({}, this.$props);
    data.tempValue = data.props.value;
    return data;
  },
};
</script>
