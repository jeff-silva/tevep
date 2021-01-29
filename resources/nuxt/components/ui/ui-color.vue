<!-- <template><div class="ui-color form-control input-group p-0" style="position:relative;">
  <input type="text" class="form-control border-0" v-model="props.value">
  <component class="ui-color-component" :is="props.type" v-model="tempValue" @input="emit(tempValue)" style="position:absolute; top:100%; left:0px; z-index:2;"></component>
  <div class="input-group-prepend " v-if="props.value"><div class="input-group-text border-0" :style="`background:${props.value}; width:30px;`"></div></div>
</div></template> -->


<template><div class="ui-color input-group" style="position:relative;">
  
  <input type="text" class="form-control" v-if="props.showInput" v-model="props.value" @focus="show($event)">

  <div class="input-group-btn">
    <a href="javascript:;" class="btn" :style="`background:${props.value};`" @click="show($event)">&nbsp;</a>
  </div>

  <ui-dropdown ref="dropdown" :style="compColorStyle">
    <template #content>
      <component class="ui-color-component"
        :is="props.type"
        v-model="tempValue"
        @input="emit(tempValue)"
      ></component>
    </template>
  </ui-dropdown>
</div></template>


<style>
/* .ui-color .ui-color-component {visibility:hidden; opacity:0; height:0px; overflow:hidden; transition: all 300ms ease;}
.ui-color:hover .ui-color-component,
.ui-color > .form-control:focus + .ui-color-component {visibility:visible; opacity:1; height:auto;} */
</style>


<script>
import { Compact, Sketch, Chrome, Photoshop } from 'vue-color';

export default {
  components: { Compact, Sketch, Chrome, Photoshop },

  props: {
    value: {default:''},
    type: {default:'chrome'},
    display: {default:false},
    showInput: {default:true},
  },

  watch: {
    $props: {deep:true, handler(value) {
      this.props = Object.assign({}, value);
    }},
  },

  data() {
    let data = {};
    data.props = Object.assign({}, this.$props);
    data.tempValue = data.props.value;
    return data;
  },

  computed: {
    compColorStyle() {
      let style = {};
      style.position = "absolute";
      style.top = "100%";
      style.left = 0;
      return style;
    },
  },

  methods: {
    emit(value) {
      this.props.value = value.hex8;
      this.$emit('input', this.props.value);
    },

    show(ev) { this.$refs.dropdown.show(ev); },
    hide(ev) { this.$refs.dropdown.hide(ev); },
    toggle(ev) { this.$refs.dropdown.toggle(ev); },
  },
};
</script>
