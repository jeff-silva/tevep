<template>
    <div>
        <ui-field label="Position">
            <select class="form-control" v-model="bind.type">
                <option :value="t" v-for="t in types">{{ t }}</option>
            </select>
        </ui-field>

        <ui-field label="Preview">
            <ui-playground :value="_code"></ui-playground>
        </ui-field>
    </div>
</template>

<script>
export default {
    head() {
		return {
			title: "Dropdown",
		};
	},

    data() {
        return {
            types: "top-left|top|top-right|right-top|right|right-bottom|bottom-right|bottom|bottom-left|left-bottom|left|left-top".split("|"),
            bind: {
                type: "bottom-left",
            },
        };
    },

    computed: {
        _code() {
            return [
                `<ui-dropdown type="${this.bind.type}" :shown="true">`,
                `\t<button type="button" class="btn btn-primary">`,
                `\t\tDropdown`,
                `\t</button>`,
                `\t`,
                `\t<template #dropdown>`,
                `\t\t<div class="p-2" style="width:150px;">`,
                `\t\t\t<div>Big</div>`,
                `\t\t\t<div>Content</div>`,
                `\t\t\t<div>${this.bind.type}</div>`,
                `\t\t</div>`,
                `\t</template>`,
                `</ui-dropdown>`,
            ].join("\n");
        },
    },
}
</script>