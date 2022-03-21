<template>
    <div>
        <ui-field label="Text">
            <textarea class="form-control" v-model="props.text"></textarea>
        </ui-field>

        <ui-field label="CTAs">
            <div class="mb-3" v-for="c in props.ctas">
                <div class="input-group">
                    <input type="text" class="form-control border-0" v-model="c.label" placeholder="Texto">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger" @click="props.ctas.splice(props.ctas.indexOf(c), 1)">
                            <i class="fas fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control border-0" v-model="c.href" placeholder="URL">
                    <select class="form-control border-0" v-model="c.target">
                        <option value="">Nenhum</option>
                        <option value="_blank">Blank</option>
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-control border-0" v-model="c.class">
                        <option value="btn">Nenhum</option>
                        <option value="btn btn-primary">Primário</option>
                        <option value="btn btn-secondary">Secundário</option>
                        <option value="btn btn-success">Sucesso</option>
                        <option value="btn btn-danger">Perigo</option>
                        <option value="btn btn-info">Informação</option>
                        <option value="btn btn-warning">Aviso</option>
                    </select>
                </div>
            </div>

            <button type="button" class="btn btn-primary w-100" @click="props.ctas.push({})">
                Adicionar CTA
            </button>
        </ui-field>
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
        ctas: {default:()=>([]), type:Array},
    },

    watch: {
        // $props: {deep:true, handler(value) {
        //     this.props = JSON.parse(JSON.stringify(value));
        // }},

        props: {deep:true, handler(value) {
            for(let i in value) {
                this.$emit(`update:${i}`, value[i]);
            }
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>