<template>
    <div class="ui-autocomplete">
        <div @keyup="search" style="position:relative;">
            <slot :params="props.params" :loading="loading" :search="search"></slot>
        </div>

        <el-collapse-transition>
            <div v-if="response && focused" :class="{'ui-autocomplete-response':true, 'ui-autocomplete-response-floating':responseFloating}">
                <slot name="response" :loading="loading" :search="search" :response="response"></slot>
            </div>
        </el-collapse-transition>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:""},
        placeholder: {default:"Buscar"},
        action: {default:"", type:String},
        method: {default:"get"},
        params: {default:()=>({}), type:Object},
        responseFloating: {default:true},
        submitOnMounted: {default:false, type:Boolean},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            loading: false,
            response: false,
            error: false,
            focused: false,
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        search() {
            this.loading = true;
            
            if (this.__searchTimeout) {
                clearTimeout(this.__searchTimeout);
            }

            this.__searchTimeout = setTimeout(() => {
                let req = this.$axios({
                    method: this.method,
                    url: this.action,
                    params: this.params,
                    body: this.params,
                });

                req.then(resp => {
                    this.loading = false;
                    this.response = resp.data;
                });

                req.catch(err => {
                    this.loading = false;
                    this.error = err.response.data;
                });
            }, 1000);
        },
    },

    mounted() {
        if (this.submitOnMounted) {
            this.search();
        }

        this.$helpers.event(this, [document], ['now', 'click'], ev => {
            this.focused = (document.activeElement && this.$el.contains(document.activeElement)) || (ev.target && this.$el.contains(ev.target));
        });
    },
}
</script>

<style>
.ui-autocomplete {position:relative;}
.ui-autocomplete-response-floating {position:absolute; top:100%; left:0; width:100%; z-index:9; max-height:300px; overflow:auto;}
</style>