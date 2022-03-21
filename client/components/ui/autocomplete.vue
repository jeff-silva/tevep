<template>
    <div class="ui-autocomplete" style="position:relative;">

        <slot name="input" :params="props.params" :loading="loading" :search="search">
            <div class="input-group form-control p-0">
                <input type="text" class="form-control border-0 shadow-none" v-model="props.params.q" :placeholder="placeholder" @keyup.enter="search()">

                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary border-0 rounded-0" @click="search()" v-loading="loading">
                        <i class="fas fa-fw fa-search"></i>
                    </button>
                </div>
            </div>
        </slot>

        <el-collapse-transition>
            <div v-if="response && props.responseShow" :style="`${responseFloating? 'position:absolute; top:100%; left:0; width:100%; z-index:9; margin-top:10px; max-height:300px; overflow:auto;': ''}`">
                <slot name="response" :response="response"></slot>
            </div>
        </el-collapse-transition>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:""},
        placeholder: {default:"Buscar"},
        action: {default:""},
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
            this.loading = true;

            this.$axios({
                url: this.props.action,
                method: this.props.method,
                params: this.props.params,
            }).then(resp => {
                this.loading = false;
                this.response = resp.data;
            }).catch(err => {
                this.loading = false;
                this.error = err.response.data;
            });
        },
    },

    mounted() {
        document.addEventListener('click', ev => {
            this.props.responseShow = this.$el.contains(ev.target);
        });
    },
}
</script>