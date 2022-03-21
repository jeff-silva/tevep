<template>
    <div class="ui-editor-html">
        <div class="p-2 border border-bottom-0">
            <div class="btn-group me-2" role="group" aria-label="Paragrafo">
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('bold');"><i class="fas fa-bold"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('italic');"><i class="fas fa-italic"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('strikeThrough');"><i class="fas fa-strikethrough"></i></button>
            </div>

            <div class="btn-group me-2" role="group" aria-label="Alinhamento">
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyLeft');"><i class="fas fa-align-left"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyCenter');"><i class="fas fa-align-center"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyFull');"><i class="fas fa-align-justify"></i></button>
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('justifyRight');"><i class="fas fa-align-right"></i></button>
            </div>
            
            <div class="btn-group me-2" role="group" aria-label="Especial">
                <button type="button" class="btn btn-sm" :disabled="codeMode" @click="command('removeFormat');"><i class="fas fa-remove-format"></i></button>
                <button type="button" class="btn btn-sm" @click="codeMode=!codeMode" :class="{'btn-primary text-white':codeMode}"><i class="fas fa-code"></i></button>
            </div>
        </div>

        <!-- Editor HTML -->
        <ui-code v-show="codeMode" v-model="props.value" language="html" style="min-height:100px;" @keyup.native="setValue(props.value)"></ui-code>
        
        <!-- Editor Wysiwyg -->
        <div v-show="!codeMode" class="form-control rounded-0" style="min-height:100px;" contenteditable="true" ref="editor" @keyup="htmlKeyup($event)"></div>

        <slot name="footer" :info="info" :value="props.value" :code-mode="codeMode"></slot>
    </div>
</template>

<script>
export default {
    props: {
        value: [Boolean, String],
    },

    data() {
        return {
            codeMode: false,
            props: JSON.parse(JSON.stringify(this.$props)),
            info: {focus:false},
        };
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.setValue(this.props.value);
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    methods: {
        setValue(value) {
            this.$refs.editor.innerHTML = value||"";
        },

        getValue() {
            return this.$refs.editor.innerHTML;
        },

        appendValue(value) {
            document.execCommand('insertHTML', false, value);
        },

        command(a, b, c) {
            document.execCommand(a, b, c);
            this.props.value = this.$refs.editor.innerHTML;
        },

        htmlKeyup(ev) {
            this.props.value = ev.target.innerHTML || '&nbsp;';
        },

        documentClick(ev) {
            this.info.focus = this.$el.contains(ev.target);
        },
    },

    mounted() {
        this.setValue(this.props.value);
        document.addEventListener("click", this.documentClick);
    },

    beforeDestroy() {
        document.removeEventListener("click", this.documentClick);
    },
}
</script>