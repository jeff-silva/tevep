<template>
    <div class="app-code">
        <div ref="monacoRef" style="min-height:300px;"></div>
        <pre>{{ propsModelValue }}</pre>
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

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    watch: {
        '$props.modelValue': {handler(value) {
            if (this.$el.contains(document.activeElement)) return;
            let monaco = this.monacoInit();
            monaco.getModel().setValue(value);
        }},
    },

    data() {
        return {
            monacoId: false,
            monacoEditor: false,
        };
    },

    methods: {
        monacoInit() {
            window.monacoInstances = window.monacoInstances||{};
            if (this.monacoId) return window.monacoInstances[this.monacoId];

            let monacoEditor = monaco.editor.create(this.$refs.monacoRef, {
                value: this.propsModelValue,
                language: this.language,
                theme: this.theme,
                readOnly: this.disabled,
                autoIndent: true,
                automaticLayout: true,
            });
            
            monacoEditor.getModel().onDidChangeContent(ev => {
                this.propsModelValue = monacoEditor.getValue();
                // this.$emit('update:modelValue', monacoEditor.getValue());
            });

            this.monacoId = 'monaco-'+(Math.round(Math.random()*9999));
            window.monacoInstances[this.monacoId] = monacoEditor;
            return monacoEditor;
        },

        resizeHandler() {
            let monacoEditor = this.monacoInit();
            if (!monacoEditor) return;
            monacoEditor.layout({width:0});
        },
    },

    mounted() {
        this.monacoInit();
        window.addEventListener('resize', this.resizeHandler);
    },

    unmounted() {
        window.removeEventListener('resize', this.resizeHandler);
        delete window.monacoInstances[this.monacoId];
    },
};
</script>