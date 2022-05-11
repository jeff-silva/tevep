<template>
    <div class="app-code">
        <v-input :label="label">
            <!-- <monaco-editor
                style="height:400px;"
                :language="language"
                :value="propsModelValue"
            ></monaco-editor> -->

        </v-input>
        <div ref="monaco" style="min-height:300px;"></div>
    </div>
</template>

<script>
// import MonacoEditor from 'monaco-editor-vue3';
import * as monaco from 'monaco-editor/esm/vs/editor/editor.api';

self.MonacoEnvironment = {
	getWorker: function (workerId, label) {
		const getWorkerModule = (moduleUrl, label) => {
			return new Worker(self.MonacoEnvironment.getWorkerUrl(moduleUrl), {
				name: label,
				type: 'module'
			});
		};

		switch (label) {
			case 'json':
				return getWorkerModule('/monaco-editor/esm/vs/language/json/json.worker?worker', label);
			case 'css':
			case 'scss':
			case 'less':
				return getWorkerModule('/monaco-editor/esm/vs/language/css/css.worker?worker', label);
			case 'html':
			case 'handlebars':
			case 'razor':
				return getWorkerModule('/monaco-editor/esm/vs/language/html/html.worker?worker', label);
			case 'typescript':
			case 'javascript':
				return getWorkerModule('/monaco-editor/esm/vs/language/typescript/ts.worker?worker', label);
			default:
				return getWorkerModule('/monaco-editor/esm/vs/editor/editor.worker?worker', label);
		}
	}
};

export default {
    // components: { MonacoEditor },

    props: {
        modelValue: {default:''},
        label: {default:''},
        language: {default:'html'},
        theme: {default:'vs-dark'},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    data() {
        return {
            monaco: false,
        };
    },

    methods: {
        async monacoInit() {
            this.monaco = monaco.editor.create(this.$refs.monaco, {
                value: this.modelValue,
                language: this.language,
                theme: this.theme,
            });
            this.monaco.getModel().onDidChangeContent(ev => {
                setTimeout(() => {
                    let value = this.$refs.monaco.querySelector('.monaco-scrollable-element').innerText;
                    this.$emit('update:modelValue', value);
                }, 100);
                // const model = this.monaco.getModel();
                // const fullModelRange = model.getFullModelRange();
                // const fullModelValue = model.getValueInRange(ev.changes[0].range, 2);
                // console.log(fullModelValue);
                // console.log(ev.changes[0].range);
                // console.log(fullModelRange);
            });
        },
    },

    mounted() {
        this.monacoInit();
    },
};
</script>