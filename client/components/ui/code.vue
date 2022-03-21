<!-- TODO: inserir auto height no editor -->

<template>
    <div ref="monaco" style="width:100%; min-height:100px;"></div>
</template>

<script>
import * as monaco from 'monaco-editor/esm/vs/editor/editor.api';

export default {
    props: {
        value: [Boolean, String],
        language: {default: "html"},
        theme: {default: "vs-dark"},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            monaco: false,
            monacoUpdateHeightIgnoreEvent: false,
        };
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.setValue(this.props.value||"");
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },
    
    methods: {
        monacoInit() {
            setTimeout(() => {
                let target = this.$refs.monaco;

                this.monaco = monaco.editor.create(target, {
                    value: (this.props.value || ""),
                    language: this.props.language,
                    theme: this.props.theme,
                    automaticLayout: true,
                    scrollBeyondLastLine: false,
                });

                this.monaco.getModel().onDidChangeContent(evt => {
                    this.props.value = this.monaco.getModel().getValue();
                    this.monacoUpdateHeight();
                });

                this.monaco.getModel().setValue(this.props.value);
                this.monacoUpdateHeight();
            }, 100);
        },

        setValue(value) {
            if (this.$el.contains(document.activeElement)) return;
            this.monaco.getModel().setValue(value);
        },
        
        getValue() {
            return this.props.value = this.monaco.getModel().getValue();
        },

        resizeHandler() {
            this.monaco.layout({width:0});
        },

        monacoUpdateHeight() {
            // let codeLines = this.$el.querySelectorAll('.view-lines > *');
            // let height = Math.max(100, codeLines[0].offsetHeight * codeLines.length);
            // this.$el.style.height = `${height}px`;


            // try {
            //     this.monacoUpdateHeightIgnoreEvent = true;
            //     this.monaco.layout({ height });
            // }
            // finally {
            //     this.monacoUpdateHeightIgnoreEvent = false;
            // }
        },
    },
    
    mounted() {
        this.monacoInit();
        window.addEventListener('resize', this.resizeHandler);
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.resizeHandler);
    },
}
</script>