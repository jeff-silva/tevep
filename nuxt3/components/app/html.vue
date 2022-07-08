<template>
    <div>
        <Script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@1/dist/tinymce-webcomponent.min.js"></Script>
        <tinymce-editor
            api-key="no-api-key"
            height="500"
            menubar="true"
            v-html="modelValue"
        ></tinymce-editor>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:'', type:String},
    },
};
</script>

<style>
.app-html-content {outline:none;}
</style>