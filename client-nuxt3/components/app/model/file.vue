<template>
    <div>
        <div style="height:300px; background:#eee;"></div>
        <v-file-input label="File input" hide-details></v-file-input>
        <pre>$props: {{ $props }}</pre>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:'', type:[Boolean, Number, String]},
    },
};
</script>