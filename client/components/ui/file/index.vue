<template>
    <div class="ui-file">
        <ui-file-content v-model="props.fileData" :preview-url="props.file? props.file.url: false">
            <template #actions="{ value, file }">
                <button type="button" class="btn btn-primary" v-if="value" @click="fileUpload()">
                    <i class="fas fa-fw fa-upload"></i>
                </button>
            </template>
        </ui-file-content>
    </div>
</template>

<script>
export default {
    props: {
        value: {default: false, type: [Boolean, String, Object]}, // id, url, object
        folder: {default: ""},
        preview: {default: "200px", type:[Boolean, String]},
        file: {default: false, type: [Boolean, Object]}, // Resposta banco de dados
        fileData: {default: false, type: [Boolean, File]},
        returnValue: {default: "id", type:[Boolean, String]}, // id, url
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.fileLoad();
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
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        fileUpload() {
            let formData = new FormData();
            formData.append('name', this.props.fileData.name);
            formData.append('folder', this.props.folder);
            formData.append('content', this.props.fileData);

            this.$axios.post('/api/files/save', formData).then(resp => {
                this.props.file = resp.data;
                this.props.value = this.getPropsValue();
            });
        },

        getPropsValue() {
            let file = this.props.file || {};
            return file[this.returnValue] || false;
        },

        fileLoad() {
            if (!this.props.value) return;

            if (this.returnValue=="id" && !isNaN(this.props.value)) {
                this.$axios.get(`/api/files/find/${this.props.value}`).then(resp => {
                    this.props.file = resp.data;
                });
            }

            else if (this.returnValue=="url") {
                let params = {url: this.props.value};
                this.$axios.get(`/api/files/search`, {params}).then(resp => {
                    this.props.file = resp.data.data[0] || false;
                });
            }
        },
    },

    mounted() {
        this.fileLoad();
    },
}
</script>