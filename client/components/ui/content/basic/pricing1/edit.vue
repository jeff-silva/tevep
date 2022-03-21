<template>
    <div>
        <ui-field label="Texto">
            <textarea class="form-control" v-model="props.text"></textarea>
        </ui-field>

        <ui-field label="Preços">
            <div class="mb-3" v-for="i in props.prices">
                <div class="input-group">
                    <input type="text" class="form-control border-0" v-model="i.label" placeholder="Texto">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger" @click="props.prices.splice(props.prices.indexOf(c), 1)">
                            <i class="fas fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control border-0" v-model="i.price" placeholder="Preço">
                </div>
            </div>

            <button type="button" class="btn btn-primary w-100" @click="props.prices.push({})">
                Adicionar preço
            </button>
        </ui-field>
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
        prices: {default:()=>([]), type:Array},
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