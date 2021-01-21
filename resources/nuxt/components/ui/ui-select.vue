
<template>
    <div class="ui-select" style="position:relative;">
        
        <div>
          <div v-if="props.value" class="bg-white p-2">
            <div v-if="props.multiple">
              <div v-for="v in props.value">
                <slot name="selected" :option="v"></slot>
              </div>
            </div>

            <div v-if="props.multiple">
              <slot name="selected" :option="props.value"></slot>
            </div>
          </div>

          <div v-else class="input-group">
            <div class="form-control" v-html="props.placeholder" @click="setDropdown(true)"></div>
            <div class="input-group-append" @click="setDropdown(!props.dropdown)"><div class="input-group-text">
              <i class="fa fa-fw fa-caret-down" v-if="props.dropdown"></i>
              <i class="fa fa-fw fa-caret-left" v-if="!props.dropdown"></i>
            </div></div>
          </div>
        </div>

        <div class="ui-select-dropdown" style="position:absolute; top:100%; left:0px; width:100%;" :class="{'ui-select-dropdown-shown':props.dropdown}">
          <input type="text" class="form-control" :placeholder="props.placeholder">
          <div class="ui-select-options">
            <slot name="options" :select="select" :toggle="toggle"></slot>
          </div>
        </div>

        <!-- <pre>$data: {{ $data }}</pre> -->
        <!-- <pre>compData: {{ compData }}</pre> -->
    </div>
</template>


<style>
.ui-select * {transition: all 300ms ease;}
.ui-select-dropdown {visibility:hidden; opacity:0; height:0px;}
.ui-select-dropdown-shown {visibility:visible; opacity:1; height:auto;}
.ui-select-options {max-height:300px; overflow:auto;}
.ui-select-options > * {display:block!important; background:#fff; padding:10px; border-top:solid 1px #eee; margin:0px;}
</style>


<script>
import Vue from 'vue';

export default {
  props: {
      value: {default:false},
      data: {default:()=>([])},
      name: {default:'some-name'},
      placeholder: {default:'Selecione'},
      dropdown: {default:false},
      multiple: {default:false},
  },

  components: {
    uiSelectOption: {
      props: {
        value: {default:()=>({})},
      },
    },
  },

  watch: {
      $props: {deep:true, handler(value) {
          this.props = Object.assign({}, value);
      }},
  },

  data() {
      return {
        options: [],
        props: Object.assign({}, this.$props),

        events: [
          {type:'click', handler: (ev) => {
            this.props.dropdown = !!ev.target.closest('.ui-select');
          }},
        ],
      };
  },

  computed: {
      compData() {
          return this.data.map(item => {
              return {
                  id: 'input-'+ (item.id || btoa(JSON.stringify(item))),
                  option: item,
              };
          });
      },
  },

  methods: {
      emit() {
          this.$emit('input', this.props.value);
      },

      setDropdown(value=null) {
        this.options = this.getOptions();
        value = value===null? (!!this.props.dropdown): value;
        this.props.dropdown = value;
      },

      getOptions() {
        let items = [];

        this.$el.querySelectorAll('.ui-select-options>*').forEach(item => {
          item.classList.add('ui-select-option');
          items.push({
            html: item.innerHTML,
            text: item.innerText,
          });
        });

        return items;
      },

      select(option) {
        this.props.multiple = false;
        this.props.value = option;
        this.emit();
      },

      toggle(option) {
        this.props.multiple = true;
        this.props.value = Array.isArray(this.props.value)? this.props.value: [];
        let index = this.props.value.indexOf(option);
        index>=0? this.props.value.splice(index, 1): this.props.value.push(option);
        this.emit();
      },
  },

  mounted() {
    this.options = this.getOptions();
    this.setDropdown();

    this.events.forEach(ev => {
      window.addEventListener(ev.type, ev.handler);
    });
  },

  beforeDestroy() {
    this.events.forEach(ev => {
      window.removeEventListener(ev.type, ev.handler);
    });
  },
}
</script>