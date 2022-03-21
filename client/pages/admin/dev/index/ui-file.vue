<template>
    <div>
        <div class="row g-0">
            <div class="col-6 p-2">
                <ui-file v-model="uiFile"></ui-file>
            </div>

            <div class="col-6 p-2">
                <ui-file-id v-model="uiFileId"></ui-file-id>
            </div>

            <div class="col-12 p-2">
                <ui-file-select v-model="uiFileId" select-field="id"></ui-file-select>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    head() {
		return {
			title: "Arquivos",
		};
	},

    data() {
        return {
            uiFile: false,
            uiFileId: 16,

            // types: "top-left|top|top-right|right-top|right|right-bottom|bottom-right|bottom|bottom-left|left-bottom|left|left-top".split("|"),
            // bind: {
            //     type: "bottom-left",
            // },
        };
    },

    // computed: {
    //     _code() {
    //         return [
    //             `<ui-dropdown type="${this.bind.type}" :shown="true">`,
    //             `\t<button type="button" class="btn btn-primary">`,
    //             `\t\tDropdown`,
    //             `\t</button>`,
    //             `\t`,
    //             `\t<template #dropdown>`,
    //             `\t\t<div class="p-2" style="width:150px;">`,
    //             `\t\t\t<div>Big</div>`,
    //             `\t\t\t<div>Content</div>`,
    //             `\t\t\t<div>Example</div>`,
    //             `\t\t</div>`,
    //             `\t</template>`,
    //             `</ui-dropdown>`,
    //         ].join("\n");
    //     },
    // },
}
</script>