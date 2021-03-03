<template><div>
    <div class="row no-gutters">
        <div class="col-6">
            <ui-carousel v-model="carouselIndex">
                <template #sliders>
                    <div v-for="n in 10" style="width:100%;">
                        <img :src="'https://source.unsplash.com/random/200x200/?r='+n" alt="" width="100%">
                    </div>
                </template>
            </ui-carousel>
        </div>

        <div class="col-6">
            <ui-carousel v-model="carouselIndex">
                <template #sliders>
                    <div v-for="n in 10" style="width:100%;">
                        <img :src="'https://source.unsplash.com/random/200x200/?r='+n" alt="" width="100%">
                    </div>
                </template>
            </ui-carousel>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            carouselIndex: 0,
        }
    },
}
</script>