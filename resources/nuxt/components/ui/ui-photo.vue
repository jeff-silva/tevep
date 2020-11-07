<template><div class="ui-photo" dropzone="copy" @drop="onDrop($event);" @dragover="$event.preventDefault()">
    <ui-modal ref="modal">
        <template #body>
            <div class="form-group">
                <label>Informe a URL do arquivo:</label>
                <input type="text" class="form-control" v-model="props.value" @keyup="$emit('input', props.value);">
            </div>

            <div class="form-group">
                <label>Ou faça upload:</label>
                <input type="file" @change="getFile($event.target.files[0]||false); $event.target.type='text'; $event.target.type='file'; modal=false;" class="form-control">
            </div>

            <div class="form-group">
                Você também pode arrastar e soltar a imagem aqui ou diretamente na miniatura da foto fora do modal.
            </div>
        </template>

        <template #footer>
            <a href="javascript:;" class="btn btn-danger float-left" @click="props.value=''; $emit('input', '');">Remover imagem</a>
        </template>
    </ui-modal>


    <div style="cursor:pointer;" v-if="props.value" @click="props.value=''; $emit('input', '');">
        <slot name="has-image">
            <img :src="compUrl" alt="" style="width:100%; margin:0px!important;">
            <a href="javascript:;" class="btn btn-outline-danger btn-block" @click="props.value=''; $emit('input', '');">
                <i class="fas fa-times"></i> Remover
            </a>
        </slot>
    </div>

    <div style="cursor:pointer;" v-else @click="props.modal=true">
        <slot name="no-image">
            <img :src="compUrl" alt="" style="width:100%; margin:0px!important;">
            <div class="m-0">
                <div class="btn btn-outline-primary btn-block" @click="props.modal=true">
                    <i class="fas fa-upload"></i> Upload
                </div>
            </div>
        </slot>
    </div>
</div></template>



<script>export default {
    name: "ui-photo",

    props: {
        value: {default: ''},
        defaultImage: {default: 'data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjYyMS4xMjdweCIgaGVpZ2h0PSI2MjEuMTI3cHgiIHZpZXdCb3g9Ijg5LjQzNyAtMTAuNTYzIDYyMS4xMjcgNjIxLjEyNyINCgkgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyA4OS40MzcgLTEwLjU2MyA2MjEuMTI3IDYyMS4xMjciIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KCTxyZWN0IHg9IjEwOS40MzciIHk9IjEwIiBmaWxsPSIjREFEQkRDIiB3aWR0aD0iNTgxLjEyNyIgaGVpZ2h0PSI1ODAuNTYyIi8+DQoJPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTUuMDAwMDAwLCAtNS4wMDAwMDApIj4NCgkJPHBhdGggZmlsbD0iI0YzRjRGNCIgZD0iTTk0LjQzNy01LjU2M2g2MjEuMTI3djYyMS4xMjdIOTQuNDM3Vi01LjU2M0w5NC40MzctNS41NjN6IE00NzUuMzQ2LDI1NC4wNTdsLTguMTg1LTQ3LjgzMUwyOTkuNjMsMjM1LjY0MQ0KCQkJbDI0LjU1MywxMzkuOTA4bDE2LjYyNy0yLjgxM3YxMi4wMjFoMTcwLjA4N1YyNTQuMDU3SDQ3NS4zNDZMNDc1LjM0NiwyNTQuMDU3eiBNMzQwLjgxMSwzNTguNjY2bC01LjM3MSwxLjAyMWwtMTkuOTUtMTEyLjc5NA0KCQkJbDE0MC40MTktMjQuODEybDUuNjI4LDMxLjk3NEgzNDAuODExVjM1OC42NjZMMzQwLjgxMSwzNTguNjY2TDM0MC44MTEsMzU4LjY2NnogTTQ5Ny4wODcsMzcwLjk0M0gzNTQuNjIxVjI2Ny44NjhoMTQyLjQ2NlYzNzAuOTQzDQoJCQlMNDk3LjA4NywzNzAuOTQzeiBNMzYzLjgyOCwyNzcuMDc1djc2LjQ3NGwyOC45MDMtMTkuMTgxbDE3LjkwMywxMS4yNTJsNDMuNDgtNDcuODI5bDUuNjI5LDIuMzAxbDI4LjEzNCwzMi40ODV2LTU1LjUwMkgzNjMuODI4DQoJCQlMMzYzLjgyOCwyNzcuMDc1TDM2My44MjgsMjc3LjA3NXogTTM5MS40NTEsMzEwLjA2OGMtNi42NDgsMC0xMi4yNzYtNS42MjYtMTIuMjc2LTEyLjI3N2MwLTYuNjUsNS42MjgtMTIuMjc5LDEyLjI3Ni0xMi4yNzkNCgkJCWM2LjY1MSwwLDEyLjI3Niw1LjYyNiwxMi4yNzYsMTIuMjc5QzQwMy43MjksMzA0LjQ0MiwzOTguMTAyLDMxMC4wNjgsMzkxLjQ1MSwzMTAuMDY4TDM5MS40NTEsMzEwLjA2OEwzOTEuNDUxLDMxMC4wNjh6Ii8+DQoJPC9nPg0KPC9zdmc+DQo='},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    computed: {
        compUrl() {
            return this.props.value || this.defaultImage;
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
        },

        toggle() {
            this.$refs.modal.toggle();
        },

        getFile(file) {
            if (! file) return;

            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.props.value = reader.result;
                this.$emit('input', this.props.value);
            };
        },
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },
};</script>
