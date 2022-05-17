<template>
    <div>
        <div class="app-html elevation-1">
            <div class="app-html-actions d-flex align-center align-content-start flex-wrap bg-grey-lighten-3">
                <v-btn-toggle class="ma-1">
                    <v-btn icon="mdi-format-align-left"></v-btn>
                    <v-btn icon="mdi-format-align-center"></v-btn>
                    <v-btn icon="mdi-format-align-right"></v-btn>
                    <v-btn icon="mdi-format-align-justify"></v-btn>
                </v-btn-toggle>
            </div>

            <div
                class="app-html-content mt-1 pa-3"
                contenteditable
                ref="content"
                @keyup="onContentKeyup($event)"
                @click="cursorInfo($event)"
            ></div>

            <!-- <app-code
                language="html"
                :modelValue="propsModelValue"
                @update:modelValue="$emit('update:modelValue', $event)"
            ></app-code> -->
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:'', type:String},
    },

    watch: {
        '$props.modelValue': {handler(value) {
            this.setValue(value);
        }},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', this.modelValue); },
        },
    },

    data() {
        return {
            cursor: this.cursorInfo(),
        };
    },

    methods: {
        setValue(value) {
            this.$emit('update:modelValue', value);
            let focused = this.$el.contains(document.activeElement);
            if (!focused) this.$refs.content.innerHTML = value;
        },
        
        cmd(command, defui=false, value='') {
            document.execCommand(command, defui, value);
        },

        onContentKeyup(ev) {
            this.setValue(ev.target.innerHTML);
            this.cursor = this.cursorInfo(ev);
        },

        cursorInfo(ev=false) {
            // const selection = (() => {
            //     if (window.getSelection) {
            //         return {
            //             text: window.getSelection().toString(),
            //             start: 0,
            //             final: 0,
            //         };
            //     }

            //     return {text:'', start:0, final:0};
            // })();

            // const caretPos = (() => {
            //     if (!ev) return 0;
            //     const element = this.$refs.content;
            //     var caretOffset = 0;
            //     var doc = element.ownerDocument || element.document;
            //     var win = doc.defaultView || doc.parentWindow;
            //     var sel;
            //     if (typeof win.getSelection != "undefined") {
            //         sel = win.getSelection();
            //         if (sel.rangeCount > 0) {
            //             var range = win.getSelection().getRangeAt(0);
            //             var preCaretRange = range.cloneRange();
            //             preCaretRange.selectNodeContents(element);
            //             preCaretRange.setEnd(range.endContainer, range.endOffset);
            //             caretOffset = preCaretRange.toString().length;
            //         }
            //     } else if ( (sel = doc.selection) && sel.type != "Control") {
            //         var textRange = sel.createRange();
            //         var preCaretTextRange = doc.body.createTextRange();
            //         preCaretTextRange.moveToElementText(element);
            //         preCaretTextRange.setEndPoint("EndToEnd", textRange);
            //         caretOffset = preCaretTextRange.text.length;
            //     }
            //     return caretOffset;
            // })();

            // const element = false;

            // return {
            //     selection,
            //     caretPos,
            //     element,
            // };

            return false;
        },
    },

    mounted() {
        this.setValue(this.modelValue);
    },
};
</script>

<style>
.app-html-content {outline:none;}
</style>