<template>
    <form :action="action" @submit.prevent="submit()" @change="formChangeHandler($event)" ref="form" v-if="tag=='form'">
        <slot v-bind="slotBind()"></slot>
    </form>

    <component v-else :is="tag">
        <slot v-bind="slotBind()"></slot>
    </component>
</template>

<script>
export default {
    props: {
        value: {type:[Boolean, Object], default:()=>({})},
        method: {default:"get"},
        action: {default:""},
        mountedSubmit: {default:false, type:Boolean},
        successText: {default:""},
        // preventMessage: {default:"Formulário sofreu alterações, deseja prosseguir?", type:[Boolean, String]},
        tag: {default:"form"},
        validationRules: {default:false, type:[Boolean, Object, Function]},
        params: {type:Object, default:()=>({})},
    },

    computed: {
        validate() {
            let constraints = false;

            if (this.validationRules.constructor.name=="Function") {
                constraints = this.validationRules();
            }
            else if (this.validationRules.constructor.name=="Object") {
                constraints = this.validationRules;
            }

            return this.$helpers.validate(this.params, constraints||{});
        },
    },

    data() {
        return {
            loading: false,
            response: {
                current_page: 1,
                path: false,
                to: 0,
                total: 0,
                data: [],
                params: [],
                attributes: [],
            },
            error: false,
            formChanged: false,
        };
    },

    methods: {
        slotBind() {
            return {
                loading: this.loading,
                params: this.params,
                validate: this.validate,
                error: this.error,
                response: this.response,
                submit: this.submit,
            };
        },

        submit() {
            if (this.validate.invalid()) return;
            let method=this.method, url=this.action, data=null, params=null;
            let headers = {'Content-Type': 'multipart/form-data' };

            if (this.method=="post") {
                data = new FormData();

                for(let i in this.params) {
                    let value = this.params[i];

                    if (typeof value=="object") {
                        value = JSON.stringify(value);
                    }

                    data.append(i, value);
                }
            }
            else {
                params = this.params;
            }

            this.loading = true;
            this.error = false;
            this.$emit('input', this.slotBind());
            
            let axios = this.$axios({ method, url, data, params, headers }).then(resp => {
                let respData = this.parseResponseData(resp.data);
                this.loading = false;
                this.response = respData;
                this.$emit('success', respData);
                this.$emit('response', respData);
                this.$emit('input', this.slotBind());
                if (this.successText) {
                    this.$swal.fire(this.successText);
                }
            }).catch(err => {
                let respData = this.parseResponseData(err.response.data);
                this.loading = false;
                this.error = respData.message;
                this.validate.errorFields = respData.fields;
                this.$emit('error', respData);
                this.$emit('response', respData);
                this.$emit('input', this.slotBind());
            });

            return axios;
        },

        formChangeHandler(ev) {
            this.formChanged = true;
            this.$emit('change', {});
            this.$emit('input', this.slotBind());
        },

        parseResponseData(respData) {
            ['per_page', 'page'].forEach(attr => {
                if (typeof respData[attr]=="string") {
                    respData[attr] = parseInt(respData[attr]);
                }
            });

            return respData;
        },

        // TODO: encontrar meio de fazer o preventRedirect para VueRouter
        // onBeforeunload(ev) {
        //     if (!this.preventMessage || !this.formChanged) return;
        //     (ev || window.event).returnValue = this.preventMessage;
        //     return this.preventMessage;
        // },
    },

    mounted() {
        // window.addEventListener("beforeunload", this.onBeforeunload);
        if (this.mountedSubmit) { this.submit(); }
        this.$emit('input', this.slotBind());
    },

    beforeDestroy() {
        // window.removeEventListener("beforeunload", this.onBeforeunload);
    },
}
</script>