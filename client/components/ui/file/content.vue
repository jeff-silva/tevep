<template>
    <div class="ui-file-content" @dragover.prevent @drop.prevent="setFile($event.dataTransfer.files[0])">

        <div class="d-flex ui-file-content-actions">
            <button type="button" class="btn btn-light flex-grow-1" @click="fileBrowser()">
                <i class="fas fa-fw fa-upload me-2"></i> {{ props.value? null: "Upload" }}
                <span v-if="file">
                    <span class="me-2 text-uppercase fw-bold">{{ file.name }}</span>
                    <span class="me-2">{{ file.size|fileSize }}</span>
                </span>
            </button>

            <slot name="actions" v-bind="slotBind"></slot>

            <div v-if="props.value">
                <button type="button" class="btn btn-danger" @click="setFile(false)">
                    <i class="fas fa-fw fa-times"></i>
                </button>
            </div>
        </div>

        <div @click="fileBrowser()"
            class="mt-2 d-flex align-items-center justify-content-center"
            :style="`height:${preview}; padding:10px; text-align:center; background:#f5f5f5; border:solid 3px #eee;`"
        >
            <template v-if="(preview && file && file.isImage) || (preview && !file && /.jpg|.jpeg|.png|.bmp|.gif/.test(previewUrl))">
                <img :style="`height:calc(${preview} - 20px);`" :src="(file && file.url)? file.url: previewUrl" alt="">
            </template>
            
            <template v-else-if="preview && file && !file.isImage">
                <div>
                    <div style="font-size:40px; text-transform:uppercase; font-weight:bold;">{{ file.ext }}</div>
                    <div>{{ file.size|fileSize }}</div>
                </div>
            </template>

            <small class="d-block text-muted" v-else>
                Solte os arquivos aqui
            </small>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {default: false, type: [Boolean, Object, File]},
        folder: {default: ""},
        preview: {default: "200px", type:[Boolean, String]},
        previewUrl: {default: "", type:[Boolean, String]},
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
            file: false,
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    computed: {
        slotBind() {
            return {
                value: this.props.value,
                file: this.file,
            };
        },
    },

    methods: {
        fileBrowser() {
            Object.assign(document.createElement("input"), {
                type: "file",
                onchange: (ev) => {
                    this.setFile(ev.target.files[0]);
                },
            }).click();
        },

        setFile(file) {
            this.props.value = file;
            this.file = file;
            
            if (file && file.constructor.name=="File") {
                let r = new FileReader();
                r.readAsDataURL(file);
                r.onload = () => {
                    this.file = {
                        name: file.name,
                        size: file.size,
                        type: file.type,
                        isImage: file.type.includes("image"),
                        ext: file.name.split('.').pop(),
                        url: r.result,
                    };
                };
            }
        },
    },
}
</script>

<style>
.ui-file-content-actions > * {margin-left: 10px;}
.ui-file-content-actions > .flex-grow-1 {margin-left: 0;}
</style>