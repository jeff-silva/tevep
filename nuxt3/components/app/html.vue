<template>
    <div>
        <div class="app-html elevation-1">
            <div class="app-html-actions d-flex align-center align-content-start flex-wrap bg-grey-lighten-3">
                <template v-for="g in actionGroups">
                    <v-btn-toggle class="ma-1">
                        <template v-for="act in g.actions">
                            <v-btn v-bind="act" @click="act.click"></v-btn>
                        </template>
                    </v-btn-toggle>
                </template>
            </div>

            <div
                class="app-html-content mt-1 pa-3 bg-white"
                contenteditable
                ref="content"
                @beforeinput="onContentChange($event)"
                @click="getInfo($event)"
                @keyup="getInfo($event)"
                @mousemove="getInfo($event)"
                @blur="getInfo($event)"
            ></div>

            <!-- <app-code :model-value="modelValue" @update:model-value="setValue($event, true)"></app-code> -->

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

    mounted() {
        this.setValue(this.modelValue, true);
    },

    data() {
        return {
            info: this.getInfo(),
            actionGroups: [
                {
                    label: 'Alinhamento',
                    actions: [
                        {
                            label: 'Left',
                            icon: 'mdi-format-align-left',
                        },
                        {
                            label: 'Center',
                            icon: 'mdi-format-align-center',
                        },
                        {
                            label: 'Right',
                            icon: 'mdi-format-align-right',
                        },
                        {
                            label: 'Justify',
                            icon: 'mdi-format-align-justify',
                            click() {
                                alert('aa');
                            },
                        },
                    ],
                },
                {
                    label: 'Types',
                    actions: [
                        {
                            label: 'Bold',
                            icon: 'mdi-delete',
                            click: ($event) => {
                                const strongElement = document.createElement("strong");
                                const userSelection = window.getSelection();
                                const selectedTextRange = userSelection.getRangeAt(0);
                                selectedTextRange.surroundContents(strongElement);
                                this.setValue(this.getValue());
                            },
                        },
                    ],
                },
            ],
        };
    },

    methods: {
        getValue() {
            return this.$refs.content.innerHTML;
        },

        setValue(value, setContentEditable=false) {
            this.$emit('update:modelValue', value);
            if (setContentEditable) {
                this.$refs.content.innerHTML = value;
            }
        },
        
        cmd(command, defui=false, value='') {
            document.execCommand(command, defui, value);
        },

        onContentChange(ev) {
            this.setValue(ev.target.innerHTML);
            this.info = this.getInfo(ev);
        },

        getInfo(ev=false) {
            let info = this.info || {};
            const text = this.propsModelValue||'';
            const content = this.$refs.content;

            info.focused = !!(content && content.contains(document.activeElement));

            info.mouse = info.mouse || {position: {x:0, y:0}};
            if (ev && ev.type=='mousemove') {
                info.mouse.position.x = ev.offsetX;
                info.mouse.position.y = ev.offsetY;
            }

            info.text = {
                size: text.length,
                selected: (() => {
                    if (ev && ['mousemove', 'keyup', 'click'].includes(ev.type) && window.getSelection) {
                        return window.getSelection().toString();
                    }
    
                    return '';
                })(),
            };

            info.caret = (() => {
                return {
                    word: '',
                    offset: (() => {
                        if (!ev) return 0;
                        const element = this.$refs.content;
                        var caretOffset = 0;
                        var doc = element.ownerDocument || element.document;
                        var win = doc.defaultView || doc.parentWindow;
                        var sel;
                        if (typeof win.getSelection != "undefined") {
                            sel = win.getSelection();
                            if (sel.rangeCount > 0) {
                                var range = win.getSelection().getRangeAt(0);
                                var preCaretRange = range.cloneRange();
                                preCaretRange.selectNodeContents(element);
                                preCaretRange.setEnd(range.endContainer, range.endOffset);
                                caretOffset = preCaretRange.toString().length;
                            }
                        } else if ( (sel = doc.selection) && sel.type != "Control") {
                            var textRange = sel.createRange();
                            var preCaretTextRange = doc.body.createTextRange();
                            preCaretTextRange.moveToElementText(element);
                            preCaretTextRange.setEndPoint("EndToEnd", textRange);
                            caretOffset = preCaretTextRange.text.length;
                        }
                        return caretOffset;
                    })(),
                    position: {x:0, y:0},
                };
            })();

            return info;
        },
    },
};
</script>

<style>
.app-html-content {outline:none;}
</style>