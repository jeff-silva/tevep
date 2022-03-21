<template>
    <div class="ui-file" @dragover.prevent @drop.prevent="fileGet($event.dataTransfer.files[0])">

        <!-- Upload -->
        <div class="d-flex align-items-center">
            <div class="flex-grow-1" v-if="!props.value">
                <button type="button" class="btn btn-light w-100" @click="fileBrowser()">
                    <div v-if="props.value">{{ props.value.name }}</div>
                    <div v-else><i class="fas fa-fw fa-file"></i> Browse</div>
                </button>
            </div>

            <div class="flex-grow-1" v-if="props.value">
                <input type="text" class="form-control" v-model="props.value.name">
            </div>
    
            <div class="ms-2" v-if="props.value">
                <button type="button" class="btn btn-light w-100" @click="fileClear()">
                    <i class="fas fa-fw fa-times"></i>
                </button>
            </div>

            <slot name="actions"></slot>
        </div>

        <!-- Preview -->
        <div class="bg-light mt-2 d-flex align-items-center justify-content-center" :style="`height:calc(${previewHeight} + 30px);`" v-if="props.preview">
            <slot name="preview" :value="props.value" :preview-height="previewHeight">
                <div v-if="_file && (_file.type||'').includes('image')">
                    <img :src="_file.url || _file.content" alt="" :style="`height:${previewHeight}; max-width:300px; object-fit:cover;`">
                    <small class="d-block text-center">{{ _file.size|fileSize }}</small>
                </div>

                <div v-else-if="_file">
                    <div style="font-size:40px; line-height:35px; text-transform:uppercase;">{{ _file.ext }}</div>
                    <small class="d-block text-center">{{ _file.size|fileSize }}</small>
                </div>

                <div v-else>Arraste o arquivo aqui</div>
            </slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {default: false, type: [Boolean, Object]},
        folder: {default: ""},
        file: {default: false, type: [Boolean, Object]},
        preview: {default: true},
        previewHeight: {default: "200px"},
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

    computed: {
        _file() {
            if (this.props.value) {
                return this.props.value;
            }
            else if (this.props.file) {
                return this.props.file;
            }
            return false;
        },
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        fileBrowser() {
            Object.assign(document.createElement("input"), {
                type: "file",
                onchange: (ev) => {
                    this.fileGet(ev.target.files[0]);
                },
            }).click();
        },

        fileGet(file) {
            let r = new FileReader();
            r.readAsDataURL(file);
            r.onload = () => {
                this.props.value = {
                    name: file.name,
                    folder: this.props.folder,
                    size: file.size,
                    mime: file.type,
                    type: file.type.split("/").shift(),
                    ext: file.name.split(".").pop(),
                    content: r.result,
                };
                this.$emit('input', this.props.value);
                this.$emit('file-get', file);
            };
        },

        fileClear() {
            this.props.value = false;
            this.$emit('file-clear', false);
        },
    },
}
</script>