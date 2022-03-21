<template>
    <div class="input-group form-control p-0">
        <input :type="props.show? 'text': 'password'" :placeholder="props.placeholder" class="form-control border-0" v-model="props.value">

        <div class="input-group-btn">
            <button type="button" class="btn" @click="props.show=!props.show">
                <i class="fas fa-eye" v-if="props.show"></i>
                <i class="fas fa-eye-slash" v-else></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:''},
        show: {default:false},
        placeholder: {default:''},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>