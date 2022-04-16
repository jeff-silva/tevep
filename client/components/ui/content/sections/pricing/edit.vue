<template>
    <div>
        <ui-field label="Descrição">
            <ui-html v-model="props.text"></ui-html>
        </ui-field>

        <ui-field label="Preços">
            <div class="mb-4" v-for="p in props.prices">
                <div class="d-flex justify-content-end mb-2">
                    <a href="javascript:;" class="btn btn-success btn-sm ms-2" @click="props.prices.push({...p});">
                        <i class="fas fa-fw fa-clone"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-danger btn-sm ms-2" @click="props.prices.splice(props.prices.indexOf(p), 1)">
                        <i class="fas fa-fw fa-times"></i>
                    </a>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-text">Título</div>
                    <input type="text" class="form-control" v-model="p.title">
                </div>

                <ui-html v-model="p.content" class="mb-2"></ui-html>

                <div class="input-group mb-2">
                    <div class="input-group-text">Preço</div>
                    <input type="text" class="form-control" v-model="p.price">
                </div>
                
                <div class="input-group mb-2">
                    <div class="input-group-text">Cor</div>
                    <input type="text" class="form-control" v-model="p.color">
                    <div class="input-group-text p-0">
                        <el-color-picker v-model="p.color"></el-color-picker>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-light w-100" @click="props.prices.push({})">
                <i class="fas fa-fw fa-plus"></i> Adicionar
            </button>
        </ui-field>

        <!-- <pre>{{ props }}</pre> -->
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
        prices: {default:()=>([]), type:Array},
    },

    watch: {
        props: {deep:true, handler(value) {
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>