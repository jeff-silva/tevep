<template>
    <div class="app-code" style="min-height:100px;">
        <div ref="monaco" style="width:100%; height:100%;"></div>
    </div>
</template>

<script>
window.require = { paths: { 'vs': '//cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.33.0/min/vs' } };

export default {
    props: {
        modelValue: {default:''},
        language: {default:'html'},
        theme: {default:'vs-dark'},
        readonly: {default:false},
        filter: {type:[Boolean, Function], default:false},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    methods: {
        monacoInit() {
            if (!this.monacoId) {
                let editor = monaco.editor.create(this.$refs.monaco, {
                    value: this.propsModelValue,
                    language: this.language,
                    theme: 'vs-dark',
                    automaticLayout: true,
                    readOnly: this.readonly,
                });

                editor.getModel().onDidChangeContent(evt => {
                    let value = this.filtered(editor.getValue());
                    this.$emit('update:modelValue', value);
                });

                this.monacoId = ('monaco-'+Math.round(Math.random()*99999));
                window.monacoInstance = window.monacoInstance || {};
                window.monacoInstance[ this.monacoId ] = editor;
            }

            return window.monacoInstance[ this.monacoId ];
        },
        filtered(value) {
            if (typeof this.filter=='function') {
                value = this.filter(value);
            }
            return value;
        },
    },

    data() {
        return {
            monacoId: false,
        };
    },

    mounted() {
        this.monacoInit();
    },
};
</script>