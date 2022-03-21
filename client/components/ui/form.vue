<template>
    <form action="" @submit.prevent="submit()" @change="formChanged=true">
        <slot :loading="loading" :response="response" :error="error" :error-fields="errorFields" :submit="submit"></slot>
    </form>
</template>

<script>
export default {
    props: {
        value: [Boolean, Object],
        method: {default:"get"},
        action: {default:""},
        mountedSubmit: {default:false, type:Boolean},
        successText: {default:""},
        preventMessage: {default:"Formulário sofreu alterações, deseja prosseguir?", type:[Boolean, String]},
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
            let headers = {'Content-Type': 'multipart/form-data'};

            if (this.method=="post") {
                data = new FormData();
                for(let name in this.value) {
                    let value = this.value[name];

                    if (Array.isArray(value)) {
                        if (value.length==0) {
                            data.append(`${name}`, '');
                            continue;
                        }

                        for(let i in value) {
                            data.append(`${name}[]`, value[i] || "");
                        }
                        continue;
                    }

                    else if (value && typeof value=="object" && (value.mime && value.content)) {
                        let arr = value.content.split(','), mime = arr[0].match(/:(.*?);/)[1], bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                        while(n--) { u8arr[n] = bstr.charCodeAt(n); }
                        data.append(name, new File([u8arr], value.name, {type:value.mime}));
                        continue;
                    }

                    data.append(name, value||'');
                }
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

        parseResponseData(respData) {
            ['per_page', 'page'].forEach(attr => {
                if (typeof respData[attr]=="string") {
                    respData[attr] = parseInt(respData[attr]);
                }
            });

            return respData;
        },

        // TODO: encontrar meio de fazer o preventRedirect para VueRouter
        onBeforeunload(ev) {
            if (!this.preventMessage || !this.formChanged) return;
            (ev || window.event).returnValue = this.preventMessage;
            return this.preventMessage;
        },
    },

    mounted() {
        window.addEventListener("beforeunload", this.onBeforeunload);
        if (this.mountedSubmit) { this.submit(); }
    },

    beforeDestroy() {
        window.removeEventListener("beforeunload", this.onBeforeunload);
    },
}
</script>