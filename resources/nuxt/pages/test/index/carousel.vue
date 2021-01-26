<template><div>
    <div class="row no-gutters">
        <div class="col-6">
            <ui-carousel v-model="carouselIndex">
                <template #sliders>
                    <div v-for="i in items" style="width:100%; border:solid 5px green;">
                        <img :src="i.src" alt="" width="100%">
                    </div>
                </template>
            </ui-carousel>
        </div>

        <div class="col-6">
            <ui-carousel v-model="carouselIndex">
                <template #sliders>
                    <div v-for="i in items" style="width:100%; border:solid 5px green;">
                        <img :src="i.src" alt="" width="100%">
                    </div>
                </template>
            </ui-carousel>
        </div>
    </div>

    <pre>$data: {{ $data }}</pre>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            carouselIndex: 0,
            items: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9].map(n => {
                return {
                    id: n,
                    text: `This is the content #${n}`,
                    src: `https://source.unsplash.com/random/200x200/?r=${n}`,
                };
            }),
        }
    },
}
</script>