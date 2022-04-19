<template>
    <form action="" @submit.prevent="submit()" @change="formChangeHandler($event)" ref="form" v-if="tag=='form'">
        <slot
            :value="value"
            :loading="loading"
            :valid="valid"
            :response="response"
            :error="error"
            :error-fields="errorFields"
            :submit="submit"
        ></slot>
    </form>

    <component v-else :is="tag">
        <slot
            :value="value"
            :loading="loading"
            :valid="valid"
            :response="response"
            :error="error"
            :error-fields="errorFields"
            :submit="submit"
        ></slot>
    </component>
</template>

<script>
import validate from 'validate.js';

export default {
    props: {
        value: [Boolean, Object],
        method: {default:"get"},
        action: {default:""},
        mountedSubmit: {default:false, type:Boolean},
        successText: {default:""},
        preventMessage: {default:"Formulário sofreu alterações, deseja prosseguir?", type:[Boolean, String]},
        tag: {default:"form"},
        findAction: {default:false, type:[Boolean, String]},
        findOnMounted: {default:false, type:[Boolean, String]},
        validate: {default:false, type:[Boolean, Object, Function]},
    },

    computed: {
        valid() {
            if (!this.formChanged) return false;
            return Object.keys(this.errorFields).length==0;
        },
    },

    data() {
        return {
            loading: false,
            response: false,
            error: false,
            errorFields: {},
            formChanged: false,
        };
    },

    methods: {
        submit() {
            let method=this.method, url=this.action, data=null, params=null;
            let headers = {'Content-Type': 'multipart/form-data' };

            if (this.method=="post") {

                const jsonToFormData = (data, parentName=false, formData=false) => {
                    formData = formData || new FormData();
                    for(let k in data) {
                        let value = data[k];
                        k = parentName? `${parentName}[${k}]`: k;

                        if (value && value.constructor.name=="Object") {
                            value = JSON.stringify(value);
                        }
                        else if (value && value.constructor.name=="Array") {
                            value = JSON.stringify(value);
                        }
                        
                        formData.append(k, value);
                    }
                    return formData;
                };

                data = jsonToFormData(this.value);
            }
            else {
                params = this.value;
            }

            this.loading = true;
            this.error = false;
            this.errorFields = {};
            
            let axios = this.$axios({ method, url, data, params, headers }).then(resp => {
                let respData = this.parseResponseData(resp.data);
                this.loading = false;
                this.response = respData;
                this.$emit('success', respData);
                this.$emit('response', respData);
                if (this.successText) {
                    this.$swal.fire(this.successText);
                }
            }).catch(err => {
                let respData = this.parseResponseData(err.response.data);
                this.loading = false;
                this.error = respData.message;
                this.errorFields = respData.fields;
                this.$emit('error', respData);
                this.$emit('response', respData);
            });

            return axios;
        },

        formChangeHandler(ev) {
            let constraints = false;

            if (this.validate.constructor.name=="Function") {
                constraints = this.validate();
            }
            else if (this.validate.constructor.name=="Object") {
                constraints = this.validate;
            }

            if (constraints) {
                this.errorFields = validate(this.value, constraints) || {};
            }

            this.formChanged = true;
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

        findOnMountedHandler() {
            if (!this.findOnMounted || !this.findAction) return;
            ((typeof this.findAction=='object')? this.$axios(this.findAction): this.$axios.get(this.findAction))
                .then(resp => {
                    let respData = this.parseResponseData(resp.data);
                    this.$emit('input', respData);
                    this.$emit('value', respData);
                    this.$emit('find', respData);
                })
                .catch(err => {
                    let respData = this.parseResponseData(err.response.data);
                    this.$emit('input', {});
                    this.$emit('value', {});
                    this.$emit('find', {});
                });
        },
    },

    mounted() {
        // window.addEventListener("beforeunload", this.onBeforeunload);
        if (this.mountedSubmit) { this.submit(); }

        this.findOnMountedHandler();
    },

    beforeDestroy() {
        // window.removeEventListener("beforeunload", this.onBeforeunload);
    },
}
</script>