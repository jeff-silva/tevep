<template><div>
    <div class="d-flex align-items-center">
        <label class="bg-white shadow-sm">
            <div style="display:inline-block; min-width:70px; height:70px;">
                <img :src="props.value" alt="" style="height:100%;">
            </div>
            <input type="file" class="form-control" style="display:none;" @change="getInputPhoto($event)">
        </label>
        <div class="flex-grow-1 pl-3">
            <div class="list-inline">
                <a href="javascript:;" class="list-inline-item" @click="props.value=''; emit();" v-if="props.value">Remover</a>
                <a href="javascript:;" class="list-inline-item" @click="getPhotoUrl()">Carregar de URL</a>
            </div>
        </div>
    </div>
</div></template>

<script>export default {
    props: {
        value: {default: ''},
        imgMaxWidth: {default: 800},
        imgMaxHeight: {default: 600},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
            },
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        getPhotoUrl() {
            this.$swalPrompt('Informe a URL da imagem', (value) => {
                this.props.value = value;
                this.emit();
            });
        },

        getInputPhoto(ev) {
            if (ev.target.files && ev.target.files[0]) {
                let file = ev.target.files[0];
                if ('image'!=file.type.split('/')[0]) { alert('O arquivo deve ser uma imagem.'); return; }
                let reader = new FileReader();
                reader.onload = (e) => {
                    let img = document.createElement("img");
                    img.src = e.target.result;

                    img.onload = () => {
                        let canvas = document.createElement('canvas');
                        let ctx = canvas.getContext("2d");
    
                        let MAX_WIDTH = parseFloat(this.imgMaxWidth);
                        let MAX_HEIGHT = parseFloat(this.imgMaxHeight);
                        let width = img.width;
                        let height = img.height;
    
                        if (width > height) {
                            if (width > MAX_WIDTH) {
                                height *= MAX_WIDTH / width;
                                width = MAX_WIDTH;
                            }
                        } else {
                            if (height > MAX_HEIGHT) {
                                width *= MAX_HEIGHT / height;
                                height = MAX_HEIGHT;
                            }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);
    
                        let dataurl = canvas.toDataURL("image/png");
                        this.props.value = dataurl;
                        this.emit();
                    };

                };
                reader.readAsDataURL(file);
            }
        },
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },
};</script>
