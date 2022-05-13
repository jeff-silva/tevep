<template>
    <div>
        <v-img
            class="bg-grey-lighten-3"
            width="100%"
            :height="previewHeight"
            :aspect-ratio="1"
            :src="fileSave.data.url"
        ></v-img>

        <v-file-input
            label="File input"
            hide-details
            @update:modelValue="fileUpload(fileSave.data.content=$event[0])"
        ></v-file-input>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:'', type:[Boolean, Number, String, Object]},
        returnType: {default:'id', type:String}, // id, object
        previewHeight: {default:'250px', type:String},
    },

    data() {
        return {
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
            this.$emit('update:modelValue', this.fileSave.data.id);
        },

        async fileUpload(file) {
            this.fileSave.data.content = file;
            let resp = await this.fileSave.submit();
            this.fileSave.data = resp.data;
            this.fileSave.data.url = resp.data.url +'?'+ Math.round(Math.random()*9999);
            this.emitValue();
        },

        async fileFind() {
            if (this.returnType=='object') {
                if (isNaN(this.modelValue.id)) return;
                this.fileSave.data = (await this.$axios.get(`/api/files/find/${this.modelValue.id}`)).data;
                return;
            }
            this.fileSave.data = (await this.$axios.get(`/api/files/find/${this.modelValue}`)).data;
        },
    },

    mounted() {
        this.fileFind();
    },
};
</script>