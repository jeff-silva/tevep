<template><div>
    <pre>rut: {{ rut }}</pre>
</div></template>

<script>
export default {
    props: {
        rut: {default:()=>({})},
    },
}
</script>