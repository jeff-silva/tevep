<template>
    <div class="app-code">
        <div ref="monacoRef" style="min-height:300px;"></div>
    </div>
</template>

<script>
import * as monaco from 'monaco-editor/esm/vs/editor/editor.api';

export default {
    props: {
        modelValue: {default:''},
        label: {default:''},
        language: {default:'html'},
        theme: {default:'vs-dark'},
        disabled: {default:false},
    },

    data() {
        return {
            monacoEditor: false,
            resizeHandler: false,
        };
    },

    methods: {
        monacoInit() {
            const monacoEditor = monaco.editor.create(this.$refs.monacoRef, {
                value: this.modelValue,
                language: this.language,
                theme: this.theme,
                autoIndent: true,
                readOnly: this.disabled,
            });
            
            monacoEditor.getModel().onDidChangeContent(ev => {
                this.$emit('update:modelValue', monacoEditor.getValue());
            });

            this.resizeHandler = () => {
                // monacoEditor.layout({width:0});
            };

            window.addEventListener('resize', this.resizeHandler);
        },
    },

    mounted() {
        this.monacoInit();
    },

    unmounted() {
        window.removeEventListener('resize', this.resizeHandler);
    },
};
</script>