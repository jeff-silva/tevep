<template>
    <div class="ui-autocomplete">

        <div @keyup="search" style="position:relative;">
            <slot :params="props.params" :loading="loading" :search="search"></slot>
        </div>

        <el-collapse-transition>
            <div v-if="response && props.responseShow" :style="`${responseFloating? 'position:absolute; top:100%; left:0; width:100%; z-index:9; margin-top:10px; max-height:300px; overflow:auto;': ''}`">
                <slot name="response" :response="response" :search="search"></slot>
            </div>
        </el-collapse-transition>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:""},
        placeholder: {default:"Buscar"},
        action: {default:"", type:[String, Object]},

        method: {default:"get"},
        params: {default:()=>({}), type:Object},
        responseFloating: {default:true},
        responseShow: {default:false},
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
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        search() {
            if (this.__searchTimeout) clearTimeout(this.__searchTimeout);
            this.__searchTimeout = setTimeout(() => {
                this.loading = true;
    
                (typeof this.action=="object"? this.$axios(this.action): this.$axios.get(this.action)).then(resp => {
                    this.loading = false;
                    this.response = resp.data;
                }).catch(err => {
                    this.loading = false;
                    this.error = err.response.data;
                });
            }, 1000);
        },
    },

    mounted() {
        document.addEventListener('click', ev => {
            this.props.responseShow = this.$el.contains(ev.target);
        });
    },
}
</script>