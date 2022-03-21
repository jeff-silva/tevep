<template>
    <div>
        <ui-field label="">
            <input type="checkbox" class="form-control" v-model="colorUse">
            <div class="d-inline-block ms-2">Utilizar cor?</div>
        </ui-field>
        
        <ui-field label="Cor" v-if="colorUse">
            <el-color-picker v-model="bind.color"></el-color-picker>
            <select class="form-control" v-model="bind.color">
                <option>var(--bs-primary);</option>
                <option>var(--bs-secondary);</option>
                <option>var(--bs-success);</option>
                <option>var(--bs-danger);</option>
                <option>var(--bs-info);</option>
                <option>var(--bs-warning);</option>
                <option>var(--bs-dark);</option>
                <option>var(--bs-indigo);</option>
                <option>var(--bs-purple);</option>
                <option>var(--bs-pink);</option>
                <option>var(--bs-orange);</option>
                <option>var(--bs-teal);</option>
                <option>var(--bs-cyan);</option>
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
			title: "Checks",
		};
	},

    data() {
        return {
            colorUse: false,
            bind: {
                color: "red",
            },
        };
    },

    computed: {
        _code() {
            let styleColor = this.colorUse? `--color: ${this.bind.color}`: '';
            return [
                `<div>`,
                `\t<label class="d-flex align-items-center mb-3">`,
                `\t\t<input type="checkbox" class="form-control" style="${styleColor}" />`,
                `\t\t<div class="flex-grow-1 ps-2">Hello</div>`,
                `\t</label>`,
                `\t`,
                `\t<label class="d-flex align-items-center mb-2">`,
                `\t\t<input type="radio" name="aaa" class="form-control" style="${styleColor}" />`,
                `\t\t<div class="flex-grow-1 ps-2">Opção A</div>`,
                `\t</label>`,
                `\t`,
                `\t<label class="d-flex align-items-center mb-2">`,
                `\t\t<input type="radio" name="aaa" class="form-control" style="${styleColor}" />`,
                `\t\t<div class="flex-grow-1 ps-2">Opção B</div>`,
                `\t</label>`,
                `\t`,
                `\t<label class="d-flex align-items-center mb-2">`,
                `\t\t<input type="radio" name="aaa" class="form-control" style="${styleColor}" />`,
                `\t\t<div class="flex-grow-1 ps-2">Opção C</div>`,
                `\t</label>`,
                `</div>`,
            ].join("\n");
        },
    },
}
</script>