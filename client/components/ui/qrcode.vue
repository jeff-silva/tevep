<template>
    <img :src="_qrcodeUrl" alt="">
</template>

<script>
export default {
    props: {
        value: {default:""},
        size: {default:"300x300"},
    },

    computed: {
        _qrcodeUrl() {
            return `https://chart.googleapis.com/chart?cht=qr&chs=${this.size}&chl=${this.value}`;
        },
    },
}
</script>