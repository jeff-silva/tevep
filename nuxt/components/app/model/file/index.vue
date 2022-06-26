<template>
    <div>
        <v-img
            width="100%"
            :height="previewHeight"
            :aspect-ratio="1"
            :src="fileSave.data.url +'?'+ fileUrlRandom"
        ></v-img>

        <v-file-input
            :label="label"
            hide-details
            @update:modelValue="fileUpload(fileSave.data.content=$event[0])"
        ></v-file-input>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:'', type:[Boolean, Number, String, Object]},
        label: {default:'Arquivo', type:String},
        returnType: {default:'id', type:String}, // object, id, url
        previewHeight: {default:'250px', type:String},
    },

    watch: {
        '$props.modelValue': {async handler() {
            this.fileFind();
        }},
    },

    data() {
        return {
            fileUrlRandom: Math.round(Math.random()*9999),
            fileSave: useAxios({
                method: "post",
                url: "/api/files/save",
                data: {content:false},
            }),
        };
    },

    methods: {
        emitValue() {
            if (this.returnType=='object') {
                this.$emit('update:modelValue', {...this.fileSave.data});
                return;
            }
            let value = this.fileSave.data[ this.returnType ] || false;
            this.$emit('update:modelValue', value);
        },

        async fileUpload(file) {
            this.fileUrlRandom = Math.round(Math.random()*9999);
            this.fileSave.data.content = file;
            let resp = await this.fileSave.submit();
            this.fileSave.data = resp.data;
            this.fileSave.data.url = resp.data.url;
            this.emitValue();
        },

        async fileFind() {
            if (this.returnType=='object') {
                if (isNaN(this.modelValue.id)) return;
                this.fileSave.data = (await this.$axios.get(`/api/files/find/${this.modelValue.id}`)).data;
            }

            else if (this.returnType=='id') {
                this.fileSave.data = (await this.$axios.get(`/api/files/find/${this.modelValue}`)).data;
            }
            
            else if (this.returnType=='url') {
                const params = { url: this.modelValue };
                const resp = (await this.$axios.get(`/api/files/search/`, { params })).data;
                if (resp.data[0]) this.fileSave.data = resp.data[0];
            }
        },
    },

    mounted() {
        this.fileFind();
    },
};
</script>